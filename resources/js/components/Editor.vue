<script setup></script>
<template>
    <input  name="content" id="editor"/>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios';

class UploadAdapter {
    constructor(loader, url) {
        this.loader = loader;
        this.url = url;
    }

    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);
                axios.post(this.url, data)
                    .then(response => {
                        if (response.data.uploaded) {
                            resolve({ default: response.data.url });
                        } else {
                            reject(response.data.error.message);
                        }
                    })
                    .catch(error => {
                        reject('Upload failed');
                    });
            }));
    }

    abort() {
        // Handle the abort method.
    }
}

export default {
    name: 'Editor',
    mounted() {
        ClassicEditor
            .create(document.getElementById('editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin]
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    document.getElementById('editor').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new UploadAdapter(loader, '/upload');
            };
        }
    },
};
</script>
