<template>
  <div v-if="links.length > 3" class="overflow-x-auto pb-3">
    <div class="flex flex-nowrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="whitespace-nowrap mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded bg-white" v-html="link.label" />
        <button v-else-if="ajax" :key="`link-${key}`" @click="fetchItems(link.url)" class="whitespace-nowrap mb-1 mr-1 px-4 py-3 text-sm leading-4 bg-white hover:bg-blue-500 hover:text-white active:text-white border focus:border-indigo-500 rounded" :class="{ 'bg-blue-600 text-white': link.active }" v-html="link.label" />
        <Link v-else :key="`link-${key}`" class="whitespace-nowrap mb-1 mr-1 px-4 py-3 text-sm leading-4 bg-white hover:bg-blue-500 hover:text-white active:text-white border focus:border-indigo-500 rounded" :class="{ 'bg-blue-600 text-white': link.active }" :href="link.url" :preserve-state="preserveState" :preserve-scroll="preserveState" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
export default defineComponent({
  components: {
    Link,
  },
  emits: ['fetchItems'],
  props: ['links', 'only', 'preserveState', 'ajax'],
  methods: {
    fetchItems(url) {
      this.$emit('fetchItems', url)
    }
  }

})
</script>