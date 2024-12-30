<template>
  <div
    class="mt-1 mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded relative"
    role="alert"
  >
    <span class="block sm:inline">{{ message }}</span>
    <button
      type="button"
      class="absolute top-0 bottom-0 right-0 px-4 py-3"
      @click="$emit('close')"
      aria-label="Close alert"
    >
      <svg
        class="fill-current h-6 w-6 text-red-500"
        role="button"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <title>Close</title>
        <path
          d="M14.348 14.849a1 1 ```vue
        0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.415l2.935-2.934-2.935-2.935a1 1 0 011.415-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.415l-2.935 2.934 2.935 2.935a1 1 0 010 1.415z"
        />
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  name: "ErrorAlert",
  props: {
    message: String,
  },
};
</script>

<style scoped>
/* Add any necessary styles */
</style>
