<script setup>
import Navigation from "@/Components/Nav.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";
const props = defineProps(["title"]);
</script>

<template>
  <div class="min-h-full">

    <Navigation/>
    <!-- Page Heading -->
    <header class="bg-white shadow" v-if="$slots.header">
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
          <slot name="header" />
        </h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
          <slot />
        </div>
        <!-- /End replace -->
      </div>
    </main>
  </div>
</template>
