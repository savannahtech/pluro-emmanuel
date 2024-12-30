import { mount } from "@vue/test-utils";
import { expect } from "chai";
import sinon from "sinon";
import axios from "axios";
import FileUpload from "@/components/FileUploadComponent.vue";

describe("FileUploadComponent.vue", () => {
  let wrapper: any;

  beforeEach(() => {
    wrapper = mount(FileUpload, {
      props: {
        errorMessage: null,
        selectedFile: null,
        loading: false,
      },
    });
  });

  afterEach(() => {
    wrapper.unmount();
  });

  it("should render the file upload form", () => {
    const uploadButton = wrapper.find('button[type="submit"]');
    const resetButton = wrapper.find('button[type="reset"]');
    expect(uploadButton.exists()).to.be.true;
    expect(resetButton.exists()).to.be.true;
  });
});
