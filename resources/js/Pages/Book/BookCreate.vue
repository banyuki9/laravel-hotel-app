<script setup>
  import { useForm, defineProps } from "@inertiajs/inertia-vue3";
  const props = defineProps(["book"]);
</script>

<template>
  <div>
    {{book}}
  </div>
</template>