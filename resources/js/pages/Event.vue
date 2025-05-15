<template>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">

                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <router-link
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            to="/">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </router-link>
                    </li>

                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <router-link v-if="user && user.is_admin"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            to="/bookingHistory">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-4">Booking History</span>
                        </router-link>
                    </li>
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>

                        <a href="#" @click.prevent="logout" v-if="user != null"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-purple-600 dark:hover:text-gray-200 dark:text-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                            <span class="ml-4">Logout</span>
                        </a>
                    </li>
                </ul>

                <div class="px-6 my-6">
                    <router-link v-if="user && user.is_admin" to="/event"
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create Event
                        <span class="ml-2" aria-hidden="true">+</span>
                    </router-link>
                </div>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->

                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <!-- Notifications menu -->

                        <!-- Profile menu -->

                    </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        BookMyPet - Event Management System
                    </h2>

                </div>
                <div class="flex justify-start mt-4 px-6">
                    <button @click="toggleModal"
                        class="w-12 cursor-pointer h-12 flex items-center justify-center rounded-full bg-purple-600 hover:bg-purple-700 text-white shadow-lg transition"
                        aria-label="Add Event">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div v-for="event in events" :key="event.name"
                        class="bg-white rounded-xl shadow-md p-5 border border-gray-100 relative hover:shadow-lg transition">

                        <!-- Header: Actions + Status -->
                        <div class="flex justify-between items-start mb-3">

                            <!-- Action buttons -->
                            <div class="flex items-center gap-2">
                                <!-- Edit -->
                                <button @click="editEvent(event)"
                                    class="text-gray-500 cursor-pointer hover:text-purple-600 transition"
                                    aria-label="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5h2m-1-1v2m9 4l-9 9H4v-7l9-9 6 6z" />
                                    </svg>
                                </button>

                                <!-- Delete -->
                                <button @click="deleteEvent(event)"
                                    class="text-red-500 cursor-pointer hover:text-red-700 transition"
                                    aria-label="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Status badge -->
                            <span :class="[
                                'text-xs font-semibold px-2 py-1 rounded-full capitalize',
                                event.status === 'open'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-800'
                            ]">
                                {{ event.status }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">
                            {{ event.name }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ event.description }}
                        </p>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 pt-3 text-sm text-gray-700 space-y-2">

                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-500">📅 Date:</span>
                                <span>{{ event.event_date }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-500">💰 Price:</span>
                                <span>{{ event.price }} JOD</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-500">👥 Capacity:</span>
                                <span>{{ event.capacity }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>

        <transition name="fade-slow">

            <div v-if="showModal"
                class="fixed inset-0 z-50 bg-[rgba(0,0,0,0.15)] backdrop-blur-sm flex items-center justify-center px-4"
                @click.self="closeModal">
                <transition name="scale-fade">
                    <div class="relative  bg-white rounded-2xl shadow-xl p-8 w-full max-w-lg transition-all"
                        @click.stop>
                        <div v-if="loading"
                            class="absolute inset-0 bg-black/60 flex items-center justify-center z-50 rounded-2xl">
                            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
                            Create New Event
                        </h2>


                        <form @submit.prevent="submitEvent">
                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">Event Name</label>
                                <input v-model="form.name" type="text" placeholder="Event Title"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>

                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">Description</label>
                                <textarea v-model="form.description" placeholder="Event Description"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    rows="3" required></textarea>
                            </div>

                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">Event Date</label>
                                <input v-model="form.event_date" type="date"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>

                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">Price (JOD)</label>
                                <input v-model.number="form.price" type="number" min="0" step="0.01" placeholder="0.00"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>

                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">Capacity</label>
                                <input v-model.number="form.capacity" type="number" min="1" step="1"
                                    placeholder="Number of Seats"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>

                            <div class="mb-6">
                                <label class="block mb-1 text-gray-700 font-medium">Status</label>
                                <select v-model="form.status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required>
                                    <option disabled value="">Select status</option>
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" @click="closeModal"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 cursor-pointer rounded-md hover:bg-gray-200 transition">
                                    Cancel
                                </button>
                                <button type="submit" :disabled="loading"
                                    class="px-4 py-2 bg-purple-600 cursor-pointer text-white rounded-md hover:bg-purple-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                    {{ eventId != null ? 'Update' : 'Create' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </transition>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showModal: false,
            loading: false,
            events: [],
            eventId: null,
            form: {
                name: null,
                description: null,
                event_date: null,
                price: null,
                capacity: null,
                status: '',
            }
        }
    },
    computed: {
        user() {
            const user = localStorage.getItem('user');
            if (user) {
                return JSON.parse(user);
            }

            return null;
        }
    },
    mounted() {
        fetch(`${import.meta.env.VITE_API_URL}/api/events`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => response.json())
            .then(json => {
                this.events = json.data;

            })
            .catch(error => {
                console.error("Error fetching events:", error);
            });
    },
    methods: {
        logout() {

            localStorage.removeItem('token');
            localStorage.removeItem('user');
            this.$router.push('/login');
        },
        submitEvent() {

            this.loading = true;
            const eventDate = new Date(this.form.event_date);

            const formattedDate = `${String(eventDate.getDate()).padStart(2, '0')}-${String(eventDate.getMonth() + 1).padStart(2, '0')}-${eventDate.getFullYear()}`;
            const isUpdate = !!this.eventId;
            const payload = {
                ...this.form,
                event_date: formattedDate,
            };
            const url = isUpdate
                ? `${import.meta.env.VITE_API_URL}/api/events/${this.eventId}`
                : `${import.meta.env.VITE_API_URL}/api/events`;
            const method = isUpdate ? "PUT" : "POST";
            fetch(url, {
                method,
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            })
                .then(async (response) => {
                    const data = await response.json();
                    this.showModal = false;
                    this.loading = false;
                    if (response.ok && data.success) {
                        this.$toast.open({
                            message: data.message || 'Event created successful!',
                            type: 'success',
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        this.$toast.open({
                            message: data.message || 'Booking failed.',
                            type: 'error',
                        });
                    }

                }).catch(error => {
                    this.$toast.open({
                        message: error.message || 'Network error occurred.',
                        type: 'error',
                    });
                    this.loading = false;

                });


        },
        deleteEvent(event) {
            fetch(`${import.meta.env.VITE_API_URL}/api/events/${event.id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                },
            })
                .then(async (response) => {
                    const data = await response.json();
                    this.loading = false;

                    if (response.ok && data.success) {
                        this.$toast.open({
                            message: data.message || 'Event deleted successfully!',
                            type: 'success',
                        });
                        setTimeout(() => location.reload(), 500);
                    } else {
                        this.$toast.open({
                            message: data.message || 'Failed to delete the event.',
                            type: 'error',
                        });
                    }
                })
                .catch(error => {
                    this.$toast.open({
                        message: error.message || 'Network error occurred.',
                        type: 'error',
                    });
                    this.loading = false;
                });

        },
        editEvent(event) {

            this.eventId = event.id;
            this.form.name = event.name;
            this.form.description = event.description;
            const [day, month, year] = event.event_date.split('/');
            this.form.event_date = `${year}-${month}-${day}`;

            this.form.price = event.price
            this.form.capacity = event.capacity;
            this.form.status = event.status;
            this.showModal = true;
        },
        toggleModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
    }
}

</script>

<style scoped>
/* Overlay fade effect */
.fade-slow-enter-active,
.fade-slow-leave-active {
    transition: opacity 0.5s ease;
}

.fade-slow-enter-from,
.fade-slow-leave-to {
    opacity: 0;
}

/* Scale + fade on modal */
.scale-fade-enter-active {
    transition: transform 0.4s ease, opacity 0.4s ease;
}

.scale-fade-leave-active {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.scale-fade-enter-from,
.scale-fade-leave-to {
    transform: scale(0.95);
    opacity: 0;
}
</style>