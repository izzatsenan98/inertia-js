<script>
    export default{
        props: {
            toast: Object,
            popstate: Boolean,
        },

        data() {
            return {
                visible: false,
                timeout: null,
            }
        },

        // TODO: watch not working because not detect change in toast
        // watch: {
        //     toast: {
        //         handler(newData, oldData) {
        //             console.log(newData, oldData)
        //         },
        //         deep: true
        //     }
        // },

        mounted() {
            if (this.toast) {
                this.visible = true;

                if (this.timeout) {
                    clearTimeout(this.timeout);
                }

                // setTimeout(() => this.visible = false, 1000);
            }
        },
    }
</script>

<template>
    <transition name="slide-fade">
        <!-- <div v-if="toast && visible" class="absolute flex max-w-xs w-full mt-4 mr-4 top-10 right-0 bg-green-400 rounded shadow p-4"> -->
        <div v-if="toast && visible" class="absolute flex max-w-xs w-full mt-4 mr-4 top-10 right-0 rounded shadow p-4" :class="toast.type == 'success' ? 'bg-green-400' : 'bg-red-500'">
            <div class="mr-2">
                <svg v-if="toast.type == 'success'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg v-if="toast.type == 'danger'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="flex-1 text-white">
                {{ toast.message }}
            </div>
            <div class="ml-2">
                <button @click="visible = false" class="align-top text-white hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
    </div>
    </transition>
</template>

<style>
.slide-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 1, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(150px);
  opacity: 0;
}

</style>
