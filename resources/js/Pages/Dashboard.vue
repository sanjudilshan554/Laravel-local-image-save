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
                            <input type="file" class="form-controller text-white" @change="handleFileChange">

                            <button type="submit" class="text-white form-controller btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="text-center text-white" style="align-items: center; justify-content: center; display: flex;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="image in imageData"> 
                                    <th>{{ image['id']}}</th>
                                    <td class="pl-5">
                                        <img :src="image['name']" alt="" width="200" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        console.log('res', response);
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

onMounted(() => {
    getImages();
})
</script>

<style>
.btn {
    background-color: wheat;
    padding: 5px;
    border-radius: 2px;
    color: black;
}
</style>
