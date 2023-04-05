

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Reservation
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">choose your best</p>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">choose
                        date</label>
                    <input v-on:change="dateChange()" type="date" id="date" :min="minDate"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        required>
                </div>
                <div class="mt-40">

                    <div class="grid grid-cols-12 gap-4 mt-5 w-2/3 font-medium w-full">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y" v-for="hour in hours">
                            <div v-if="isReserved(hour)">
                                <div v-if="isReservedByUser(hour)">
                                    <div @dblclick="remove(hour)"
                                        class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg cursor-pointer bg-green-600  p-4">
                                        {{ hour }}
                                    </div>
                                </div>
                                <div v-if="!isReservedByUser(hour)">
                                    <div
                                        class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg cursor-not-allowed bg-red-600 p-4">
                                        {{ hour }}
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div @click="getHour(hour)" id="hour"
                                    class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg cursor-pointer  p-4"
                                    :class="{ 'bg-white': !isReserved(hour) }">
                                    {{ hour }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <button type="button" @click="addAppointement()"
                    class="py-3 px-5 text-sm font-medium bg-gray-800 text-center items-center justify-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    reserver</button>
            </form>
            <!-- <button @click="haveAppointement()">check</button> -->
        </div>
    </section>
</template>
<style></style>
<script >




export default {
    name: 'App',
    data() {
        return {
            isClicked: false,
            minDate: '',
            dataUser: [],
            token: '',
            date: '',
            hour: '',
            data: [],
            hours: this.normal,
            normal: ["09:00", "10:00", "11:00", "14:00",
                "15:00", "16:00", "17:00", "18:00",
                "19:00", "20:00", "21:00"],
            friday: [
                "09:00", "10:00", "11:00", "16:00", "17:00", "18:00",
                "19:00", "20:00", "21:00"],
            sunday: ["09:00", "10:00", "11:00"]

        }

    },
    beforeCreate() {
        if (localStorage.getItem('user') === null) {
            location.href = '/register'
        }
    },
    async mounted() {
        const user = JSON.parse(localStorage.getItem('user'));
        this.dataUser = await fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/userAppointement/' + user.id_user).then(response => response.json());
        // this.dateChange();

    },
    created() {
        const today = new Date().toISOString().split('T')[0];
        this.minDate = today;
        // console.log(this.minDate);
    },
    components: {
    },
    methods: {
        remove(hour) {
            if (confirm("delete") == true) {
                fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/deleteAppointment', {
                    method: 'Post',
                    body: JSON.stringify({
                        client_id: JSON.parse(localStorage.getItem('user')).id_user,
                        date_reservation: this.date,
                        heure_reservation: hour,
                    })
                }
                );
                this.userAppointements();
                this.dateChange();
            }
        },
        async addAppointement() {
            if (this.haveAppointement()) {
                if (confirm("add" + this.hour)) {
                    await fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/addAppointment', {
                        method: 'POST',
                        body: JSON.stringify({
                            date_reservation: this.date,
                            heure_reservation: this.hour,
                            id_client: JSON.parse(localStorage.getItem('user')).id_user,
                        })
                    })
                    // this.userAppointements();
                    // // this.isReservedByUser(hour);
                    this.userAppointements();
                    this.dateChange();
                }
            }else{
                alert('you have a hour in this date');
            }
        },
        dateChange() {
            this.date = document.querySelector('#date').value;
            fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/checkByDate/' + this.date)
                .then(response => {
                    if (response.ok) {
                        // console.log(response.json());
                        return response.json();
                    } else {
                        throw new Error('Request failed');
                    }
                })
                .then(data => {
                    this.data = data;
                    let checkdate = new Date(this.date);
                    if (checkdate.getDay() == 5) {
                        this.hours = this.friday;
                    } else if (checkdate.getDay() == 0) {
                        this.hours = this.sunday
                    } else {
                        this.hours = this.normal
                    }
                });

        },
        getHour(hour) {
            this.hour = hour
        },
        isReserved(hour) {
            for (var i = 0; i < this.data.length; i++) {
                if (this.data[i].heure_reservation == hour) {
                    return true
                }
            };
        },
        async userAppointements() {
            const user = JSON.parse(localStorage.getItem('user'));
            this.dataUser = await fetch('http://localhost/brief-8-Resevation-Salon/backend/Appointments/userAppointement/' + user.id_user).then(response => response.json());
        },
        isReservedByUser(hour) {
            // console.log(this.dataUser);
            const userAppointements = this.dataUser;
            for (let i = 0; i < userAppointements.length; i++) {
                // console.log(userAppointements[i].heure_reservation == hour, hour);
                if (userAppointements[i].heure_reservation === hour) {
                    return true;
                }
            }
            return false
        },

        haveAppointement() {
            let countHour = 0;
            for (let i = 0; i < this.dataUser.length; i++) {
                if (this.dataUser[i].date_reservation == this.date && this.dataUser[i].heure_reservation != null) {
                    countHour++
                }
            }
            console.log(countHour);
            if (countHour != 0) {
                return false;
            }
            return true;

        }
    },

}

</script>