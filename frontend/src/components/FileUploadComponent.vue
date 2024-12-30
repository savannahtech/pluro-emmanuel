<template>
  <div
    class="bg-white p-6 rounded-md shadow-md w-full md:w-[400px] flex-none h-[400px] overflow-y-auto"
  >
    <ErrorAlert
      v-if="errorMessage"
      :message="errorMessage"
      @close="closeError"
    />
    <h2 class="text-lg font-bold text-gray-700 mb-4">File Upload Form</h2>
    <form @submit.prevent="handleSubmit">
      <label for="file-input" class="sr-only">Upload an HTML file</label>
      <div
        class="border-2 border-dashed border-blue-500 rounded-lg p-6 text-center relative h-[180px] flex items-center justify-center"
      >
        <input
          id="file-input"
          type="file"
          accept=".html"
          ref="fileInput"
          class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
          @change="handleFileChange"
          aria-label="Upload an HTML file to check accessibility"
          title="Select an HTML file for accessibility check"
        />
        <div class="flex flex-col items-center">
          <svg
            v-if="!selectedFile"
            class="h-12 w-12 text-blue-500 mb-3"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M 20.42 16.58a7 7 0 00-13.42-3.42A4.992  4.992  0 003 16a5 5 0 005 5h12a5 5 0 000-10z"
            />
          </svg>
          <p v-if="!selectedFile" class="text-gray-600 font-medium">
            Click here to Select Your File
          </p>
          <div v-if="selectedFile" class="flex items-center">
            <svg
              class="h-6 w-6 text-blue-500 mr-2"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10 9V5a1 1 0 011-1h6a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V9a1 1 0 011-1h6a1 1 0 011 1z"
              />
            </svg>
            <span class="text-gray-600 font-medium">{{
              selectedFile.name
            }}</span>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row justify-between mt-4 gap-4">
        <button
          class="bg-blue-600 text-white py-2 px-8 rounded-lg w-full md:w-auto"
          type="submit"
          :disabled="loading"
          :aria-disabled="loading"
          :class="{ 'opacity-50 cursor-not-allowed': loading }"
          aria-label="Upload file"
        >
          Upload File
        </button>
        <button
          class="bg-gray-600 text-white py-2 px-8 rounded-lg w-full md:w-auto"
          type="reset"
          @click="resetForm"
          :disabled="loading"
          :class="{ 'opacity-50 cursor-not-allowed': loading }"
          aria-label="Reset form"
        >
          Reset
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import ErrorAlert from "@/components/ErrorAlert.vue";

export default {
  name: "FileUploadComponent",
  components: { ErrorAlert },
  props: {
    errorMessage: String,
    selectedFile: Object,
    loading: Boolean,
  },
  methods: {
    handleFileChange(event) {
      const file = event.target.files[0];
      this.$emit("file-change", file);
    },
    resetForm() {
      this.$emit("reset");
    },
    handleSubmit() {
      this.$emit("submit");
    },
    closeError() {
      this.$emit("close-error");
    },
  },
};
</script>

<style scoped>
/* Add any necessary styles */
</style>
