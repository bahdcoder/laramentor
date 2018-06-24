<template>
  <div class="grid-container">
    <div class="grid-item grid-item-right mt-3 px-3">
        <router-view></router-view>
    </div>
    <div class="grid-item ml-2 grid-item-left">
        <vue-request-filters></vue-request-filters>
    </div>
    <vue-single-request :auth_id="authId"></vue-single-request>
</div>
</template>

<script>
export default {
  mounted() {
    console.log(this.$route);
  },
  data() {
    return {
      authId: window.authId
    };
  }
};
</script>

