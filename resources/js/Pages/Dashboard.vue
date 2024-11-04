<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Local image save service
                    </div>
                </div>

                <div class="">
                    <form @submit.prevent="saveImage">
                        <input type="file" @change="handleFileChange">

                        <button type="submit" class="text-white">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref }  from 'vue';


const data = ref({
    image: null,
});

const handleFileChange = (event) => {
    data.value.image = event.target.files[0];
}

const saveImage = async () => {
    try{
        console.log('data', data.value);
        const response  = await axios.post(route('image.store'), data.value,{
            headers:{
                'Content-Type': 'multipart/form-data',
            },
        });
        console.log('res',response);
    }catch(error){
        console.log('error', error);
    }
}

</script>

