<template>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-contain w-full h-full dark:hidden"
                        src="../../../public/assets/bookmypet.png" alt="Office" />

                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">

                    <div class="w-full">
                        <form @submit.prevent="login">
                            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                                Login
                            </h1>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Email
                                </label>
                                <input required v-model="form.email" type="email" placeholder="you@example.com"
                                    class="w-full px-4 py-2 text-sm text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Password
                                </label>
                                <input required v-model="form.password" type="password" placeholder="••••••••••••"
                                    class="w-full px-4 py-2 text-sm text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" />
                            </div>

                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Log in
                            </button>
                        </form>





                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: null,
                password: null,
            }
        }
    },
    methods: {
        async login() {
            try {
                const response = await fetch(`${import.meta.env.VITE_API_URL}/api/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.form)
                });

                const json = await response.json();

                if (!response.ok) {
                    this.$toast.open({
                        message: data.message || 'Login error',
                        type: 'error'
                    });
                    return;
                }


                localStorage.setItem('token', json.data.token);
                localStorage.setItem('user', JSON.stringify(json.data.user));



                this.$router.push('/');

            } catch (error) {
                this.$toast.open({
                    message: error.message || 'Login error',
                    type: 'error'
                });
            }
        }
    }
}

</script>
