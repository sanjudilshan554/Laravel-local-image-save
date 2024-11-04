<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Local image save service
                    </div>

                    <div class="text-center pb-5">
                        <form @submit.prevent="saveImage">
                            <input type="file" class="form-controller" @change="handleFileChange">

                            <button type="submit" class="text-white form-controller btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="text-center text-white">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">image</th>
                                    <th scope="col"> d</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="image in imageData">
                                    <td>{{ image.id }}</td>
                                    <td class="text-center">
                                        <img :src="image.name" alt="" width="200"
                                            class="text-center align-item-center just">
                                    </td>
                                    <td><i class="bi bi-trash text-danger cursor-pointer"
                                            @click.prevent="openDeleteModal(image.id)"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want delete that image?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="closeDeleteModal">Cancel</button>
                        <button type="button" class="btn btn-danger" @click.prevent="deleteImage">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';


const data = ref({
    image: null,
});

const imageData = ref([]);

const image = ref({});

const handleFileChange = (event) => {
    data.value.image = event.target.files[0];
}

const saveImage = async () => {
    try {
        console.log('data', data.value);
        const response = await axios.post(route('image.store'), data.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
        getImages();
    } catch (error) {
        console.log('error', error);
    }
}

const getImages = async () => {
    try {
        const response = await axios.get(route('image.all'));
        imageData.value = response.data;
        console.log('res', response);
    } catch (error) {
        console.log('error', error);
    }
}

const openDeleteModal = async (image_id) => {
    try {
        const response = await axios.get(route('image.get',image_id));
        image.value = response.data;
        $('#exampleModal').modal('show');
    } catch (error) {
        console.log('error', error);
    }
}

const closeDeleteModal = async () => {
    try { 
        $('#exampleModal').modal('hide');
    } catch (error) {
        console.log('error', error);
    }
}


const deleteImage = async () => {
    try {
        const response = await axios.post(route('image.delete'), image.value); 
        getImages();
    } catch (error) {
        console.log('error', error);
    }

}

onMounted(() => {
    getImages();
})
</script>

<style></style>
