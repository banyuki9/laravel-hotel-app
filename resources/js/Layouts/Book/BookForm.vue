<script setup>

</script>

<template>
  <div class="flex max-w-5xl m-auto">
    <div class="form basis-2/3 p-6" v-if="$slots.form">
      <slot name="form" />
    </div>
    <div class="information basis-1/3 p-6" v-if="$slots.information">
      <slot name="information" />
    </div>
  </div>

</template>