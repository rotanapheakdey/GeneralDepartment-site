<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { useI18n } from "vue-i18n";

const page = usePage();
const settings = computed(() => page.props.settings || {});
const { locale } = useI18n();
</script>

<template>
    <footer class="bg-slate-900 text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12 text-center md:text-left">
                <div class="space-y-4">
                    <h4 class="text-xl font-bold text-white">{{ settings.dept_name?.[locale] || 'MoI' }}</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ settings.footer_description?.[locale] || 'Official digital gateway for the Ministry of Information. Ensuring transparency and accessibility for all citizens.' }}
                    </p>
                </div>

                <div class="space-y-4">
                    <h4 class="text-sm font-bold uppercase tracking-widest text-[#FFD700]">{{ $t('footer.resources') }}</h4>
                    <ul class="text-sm text-slate-400 space-y-2">
                        <li><a href="#" class="hover:text-white transition">{{ $t('footer.privacy_policy') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ $t('footer.terms_of_service') }}</a></li>
                        <li><a href="#" class="hover:text-white transition">{{ $t('footer.media_kit') }}</a></li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h4 class="text-sm font-bold uppercase tracking-widest text-[#FFD700]">{{ $t('footer.system_engineer') }}</h4>
                    <p class="text-sm text-slate-400">
                        {{ $t('footer.designed_by') }}:<br>
                        <span class="text-white font-medium italic">Rotana Pheakdey</span><br>
                        <span class="text-white font-medium italic">KEO Chournsocheat</span><br>
                        <span class="text-white font-medium italic">Khom Socheat</span>
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 text-center">
                <p class="text-[11px] opacity-60 uppercase tracking-[0.3em]">
                    © 2026 {{ settings.dept_name?.[locale] || 'Ministry of Information' }}. {{ $t('footer.rights') }}
                </p>
                <p class="text-[9px] mt-2 opacity-30 italic">
                    {{ $t('footer.academic') }}
                </p>
            </div>
        </div>
    </footer>
</template>
