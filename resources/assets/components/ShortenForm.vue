<template>
  <form id="shortenForm" @submit.prevent="submit">
    <input
      type="url"
      v-model="url"
      class="form-control mb-3"
      placeholder="What URL do you want shortened?"
      required
      autocomplete="off"
    />

    <transition name="fade" mode="out-in">
      <div v-if="responseLength" class="mb-3" key="loaded">
        <div class="d-flex" v-if="'short_url' in response">
          <input
            id="shorturl"
            class="form-control"
            :value="response.short_url"
            readonly
          />
          <button
            type="button"
            class="btn btn-dark clipboardBtn"
            data-clipboard-target="#shorturl"
          >
            Copy
          </button>
        </div>
        <h3
          class="h3 font-weight-normal limit-height"
          v-if="'error_msg' in response"
        >
          {{ response.error_msg }}
        </h3>
      </div>

      <div v-if="preloader" class="mb-3" key="loading">
        <div class="half-circle-spinner">
          <div class="circle circle-1"></div>
          <div class="circle circle-2"></div>
        </div>
      </div>
    </transition>

    <button type="submit" class="btn btn-lg btn-dark btn-block">
      Go for it!
    </button>
  </form>
</template>

<script>
import ClipboardJS from "clipboard";

export default {
  data() {
    return {
      preloader: false,
      response: {},
      url: "",
    };
  },
  computed: {
    responseLength: function () {
      return Object.keys(this.response).length;
    },
  },
  created() {
    new ClipboardJS(".clipboardBtn");
  },
  methods: {
    submit: function () {
      this.response = {};
      this.preloader = true;

      axios
        .post("/create_url", {
          url: this.url,
        })
        .then(({ data }) => {
          this.response = data;
          this.preloader = false;
        })
        .catch(() => {
          this.response = {
            error_msg: "Something went wrong! Please try again...",
          };
          this.preloader = false;
        });
    },
  },
};
</script>