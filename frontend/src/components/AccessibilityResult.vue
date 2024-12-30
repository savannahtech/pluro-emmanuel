<template>
  <div
    class="bg-white p-6 rounded-lg shadow-md flex-grow min-h-[500px] mt-4 md:mt-0"
  >
    <h2 class="text-lg font-bold text-gray-700 mb-4">
      File Accessibility Result
    </h2>
    <h4
      v-if="!loading && results.length"
      class="text-lg font-bold text-gray-700 mb-4"
    >
      The File Accessibility Result is {{ scores }} %
    </h4>
    <div class="relative min-h-[200px] flex items-center justify-center">
      <div
        v-if="loading"
        class="absolute inset-0 flex items-center justify-center"
        role="status"
      >
        <svg
          class="animate-spin h-10 w-10 text-blue-600"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
          ></circle>
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8v8H4z"
          ></path>
        </svg>
      </div>
      <div>
        <div class="overflow-x-auto">
          <table
            v-if="!loading && results.length"
            class="w-full border-collapse table-auto hidden md:table"
          >
            <thead>
              <tr class="bg-gray-100">
                <th class="border p-2 text-left">#</th>
                <th class="border p-2 text-left">Type</th>
                <th class="border p-2 text-left">Element</th>
                <th class="border p-2 text-left">Message</th>
                <th class="border p-2 text-left">MetaData Rule</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(issue, index) in results"
                :key="index"
                class="border-b"
              >
                <td class="p-2">{{ index + 1 }}</td>
                <td class="p-2">{{ issue.type }}</td>
                <td class="p-2">{{ issue.element }}</td>
                <td class="p-2">{{ issue.message }}</td>
                <td class="p-2">{{ issue.rule }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-if="!loading && results.length" class="md:hidden">
          <div
            v-for="(issue, index) in results"
            :key="index"
            class="border p-4 mb-4 rounded-lg shadow-md"
          >
            <p><strong>#:</strong> {{ index + 1 }}</p>
            <p><strong>Type:</strong> {{ issue.type }}</p>
            <p><strong>Element:</strong> {{ issue.element }}</p>
            <p><strong>Message:</strong> {{ issue.message }}</p>
            <p><strong>MetaData Rule:</strong> {{ issue.rule_metadata }}</p>
          </div>
        </div>
        <div v-else-if="!loading" class="text-center text-gray-600">
          No results available.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AccessibilityResult",
  props: {
    results: Array,
    scores: Number,
    loading: Boolean,
  },
};
</script>

<style scoped>
/* Add any necessary styles */
</style>
