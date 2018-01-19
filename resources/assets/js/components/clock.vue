<template>
 <div class="clock__wraper text-center h3 display-3">
    <Clock :blink="true" :displaySeconds="true" />
 </div>
</template>

<script>

import Clock from "vue-digital-clock";

export default{
  components:{Clock}
}

</script>

<style lang="scss">
@import "resources/assets/sass/colors";
  .clock {
    //background-color:lighten($brand-primary,2);
    color: $white;
    padding: .3rem .6rem;
    font-size: 3rem;
    font-family: 'Menlo', monospace;
    border:2px solid $white;

  }

  // .clock__wraper
  // {
  //   border:2px solid
  //   // background-color:$brand-primary;

  // }
</style>
