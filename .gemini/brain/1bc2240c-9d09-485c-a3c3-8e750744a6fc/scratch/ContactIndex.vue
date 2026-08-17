<script setup>
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import { ref } from 'vue';

const props = defineProps({
    settings: Object,
});

const { locale } = useI18n({ useScope: 'global' });

const form = ref({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const submitForm = () => {
    // Prevent actual submission for UI demo
    alert(locale.value === 'km' ? 'សាររបស់អ្នកត្រូវបានផ្ញើដោយជោគជ័យ។ សូមអរគុណ!' : 'Your message has been sent successfully. Thank you!');
    form.value = { name: '', email: '', phone: '', subject: '', message: '' };
};
</script>

<template>
    <Head :title="locale === 'km' ? 'ទំនាក់ទំនង' : 'Contact Us'" />

    <GovLayout :settings="settings">
        <div class="bg-slate-50 min-h-screen py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header -->
                <div class="text-center mb-16">
                    <h1 class="text-3xl md:text-5xl font-bold text-moi-navy mb-4 font-sans tracking-tight">
                        {{ locale === 'km' ? 'ទំនាក់ទំនងក្រសួងព័ត៌មាន' : 'Contact Ministry of Information' }}
                    </h1>
                    <div class="w-24 h-1 bg-moi-red mx-auto rounded-full mb-6"></div>
                    <p class="text-slate-600 max-w-2xl mx-auto text-lg leading-relaxed">
                        {{ locale === 'km' ? 'សូមទំនាក់ទំនងមកកាន់ពួកយើងសម្រាប់ព័ត៌មានបន្ថែម ឬសេវាសាធារណៈផ្សេងៗ។' : 'Get in touch with us for general inquiries, press information, or public services.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    
                    <!-- Left Column: Contact Info & Map -->
                    <div class="lg:col-span-5 space-y-8">
                        
                        <!-- Contact Cards -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 space-y-8 relative overflow-hidden">
                            <!-- Background Decoration -->
                            <div class="absolute -right-10 -top-10 w-40 h-40 bg-moi-blue-50/10 rounded-full blur-3xl"></div>
                            
                            <!-- Address -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-moi-blue-50/20 text-moi-blue flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ locale === 'km' ? 'អាសយដ្ឋាន' : 'Address' }}</h3>
                                    <p class="text-slate-600 leading-relaxed">
                                        {{ locale === 'km' ? 'អគារលេខ ៦២ មហាវិថីព្រះមុនីវង្ស រាជធានីភ្នំពេញ ព្រះរាជាណាចក្រកម្ពុជា' : 'No. 62, Preah Monivong Boulevard, Phnom Penh, Cambodia' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-moi-blue-50/20 text-moi-blue flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ locale === 'km' ? 'ទូរស័ព្ទ' : 'Phone' }}</h3>
                                    <p class="text-slate-600">+855 (0)23 724 159</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-moi-blue-50/20 text-moi-blue flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ locale === 'km' ? 'អ៊ីមែល' : 'Email' }}</h3>
                                    <p class="text-slate-600">information@information.gov.kh</p>
                                </div>
                            </div>

                            <!-- Office Hours -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-moi-blue-50/20 text-moi-blue flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ locale === 'km' ? 'ម៉ោងធ្វើការ' : 'Office Hours' }}</h3>
                                    <p class="text-slate-600">{{ locale === 'km' ? 'ច័ន្ទ - សុក្រ: ៨:០០ ព្រឹក – ៥:០០ ល្ងាច' : 'Mon - Fri: 8:00 AM – 5:00 PM' }}</p>
                                    <p class="text-sm text-slate-400 mt-1">{{ locale === 'km' ? '(ឈប់សម្រាកថ្ងៃសៅរ៍ អាទិត្យ និងបុណ្យជាតិ)' : '(Closed on Weekends and Public Holidays)' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Map Embed -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-64 relative">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m3!1d3908.7618274187017!2d104.91924611532822!3d11.568892191786524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513e9a5bdad1%3A0x6b4f70c57c4f4a3e!2sMinistry%20of%20Information!5e0!3m2!1sen!2skh!4v1628156108169!5m2!1sen!2skh" 
                                class="absolute inset-0 w-full h-full border-0" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>

                    </div>

                    <!-- Right Column: Contact Form -->
                    <div class="lg:col-span-7">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 md:p-10">
                            <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">
                                {{ locale === 'km' ? 'ផ្ញើសារមកកាន់ពួកយើង' : 'Send Us a Message' }}
                            </h2>
                            
                            <form @submit.prevent="submitForm" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">{{ locale === 'km' ? 'ឈ្មោះរបស់អ្នក' : 'Your Name' }} <span class="text-moi-red">*</span></label>
                                        <input v-model="form.name" type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-moi-blue/50 focus:border-moi-blue outline-none transition-all" :placeholder="locale === 'km' ? 'ឈ្មោះពេញ' : 'John Doe'">
                                    </div>
                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">{{ locale === 'km' ? 'អ៊ីមែល' : 'Email Address' }} <span class="text-moi-red">*</span></label>
                                        <input v-model="form.email" type="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-moi-blue/50 focus:border-moi-blue outline-none transition-all" :placeholder="locale === 'km' ? 'ឈ្មោះ@ឧទាហរណ៍.com' : 'john@example.com'">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">{{ locale === 'km' ? 'លេខទូរស័ព្ទ' : 'Phone Number' }}</label>
                                        <input v-model="form.phone" type="tel" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-moi-blue/50 focus:border-moi-blue outline-none transition-all" :placeholder="locale === 'km' ? '+៨៥៥ ...' : '+855 ...'">
                                    </div>
                                    <!-- Subject -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">{{ locale === 'km' ? 'ប្រធានបទ' : 'Subject' }} <span class="text-moi-red">*</span></label>
                                        <input v-model="form.subject" type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-moi-blue/50 focus:border-moi-blue outline-none transition-all" :placeholder="locale === 'km' ? 'គោលបំណង...' : 'How can we help you?'">
                                    </div>
                                </div>

                                <!-- Message -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">{{ locale === 'km' ? 'សារ' : 'Message' }} <span class="text-moi-red">*</span></label>
                                    <textarea v-model="form.message" required rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-moi-blue/50 focus:border-moi-blue outline-none transition-all resize-none" :placeholder="locale === 'km' ? 'សរសេរសាររបស់អ្នកនៅទីនេះ...' : 'Write your message here...'"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full md:w-auto bg-moi-navy hover:bg-moi-blue text-white font-semibold py-3 px-8 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                                    <span>{{ locale === 'km' ? 'ផ្ញើសារ' : 'Send Message' }}</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </GovLayout>
</template>
