<template>
  <div class="min-h-screen" id="app">
    <HeaderComponent />
    <main class="container mx-auto px-4 py-8">
      <h1 class="text-2xl font-bold text-gray-700 mb-4">
        Accessibility Checker
      </h1>
      <nav class="text-gray-500 mb-8">
        <a class="hover:underline" href="#">Accessibility</a> /
        <a class="hover:underline" href="#">Checker</a> /
        <span>Forms</span>
      </nav>
      <div class="flex flex-col md:flex-row gap-8">
        <FileUploadComponent
          :errorMessage="errorMessage"
          :selectedFile="selectedFile"
          :loading="loading"
          @file-change="handleFileChange"
          @reset="resetForm"
          @submit="handleSubmit"
          @close-error="closeError"
        />
        <AccessibilityResult
          :results="results"
          :scores="scores"
          :loading="loading"
        />
      </div>
    </main>
  </div>
</template>

<script type="ts">
import HeaderComponent from "@/components/HeaderComponent.vue";
import AccessibilityResult from "@/components/AccessibilityResult.vue";
import axios from "axios";
import FileUploadComponent from "@/components/FileUploadComponent.vue";

export default {
  components: {
    FileUploadComponent,
    HeaderComponent,
    AccessibilityResult,
  },
  data() {
    return {
      errorMessage: null,
      selectedFile: null,
      loading: false,
      results: [],
      scores: null,
    };
  },
  methods: {
    handleFileChange(file) {
      if (!file) {
        this.errorMessage = "Please select a file to upload.";
        return;
      }
      if (file.type !== "text/html") {
        this.errorMessage = "Invalid file type. Please upload an HTML file.";
        return;
      }
      if (file.size > 5 * 1024 * 1024) {
        this.errorMessage =
          "File is too large. Please upload a file under 5MB.";
        return;
      }
      this.selectedFile = file;
    },
    resetForm() {
      this.selectedFile = null;
      this.errorMessage = null;
      this.scores = null;
      this.results = [];
    },
    async handleSubmit() {
      if (!this.selectedFile) {
        this.errorMessage = "Please select a file to upload.";
        return;
      }

      this.loading = true;
      this.errorMessage = "";
      this.results = [];

      const formData = new FormData();
      formData.append("file", this.selectedFile);

      try {
        const apiUrl = `${process.env.VUE_APP_API_URL}/analyze`;
        const response = await axios.post(apiUrl, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        this.results = response.data.data.issues || [];
        this.scores = response.data.data.score || 0;
        this.errorMessage = "";
      } catch (error) {
        this.errorMessage =
          error.response?.data?.message || "File upload failed.";
      } finally {
        this.loading = false; // Stop loading
      }
    },
    closeError() {
      this.errorMessage = "";
    },
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
</style>
