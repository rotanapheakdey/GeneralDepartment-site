<x-filament-panels::page>
    <div class="space-y-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Click the button above to generate a full system backup. This will export a ZIP archive containing a complete SQL dump of the database, as well as all uploaded media, documents, and files in your public storage directory.
        </p>
        
        <div class="p-4 bg-amber-50 dark:bg-amber-900/30 rounded-xl ring-1 ring-amber-200 dark:ring-amber-800">
            <h3 class="text-sm font-semibold text-amber-800 dark:text-amber-200">Security Notice</h3>
            <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">
                Backup ZIP files contain sensitive database information, including user credentials and API tokens. Please store the downloaded archive in a secure location and do not share it.
            </p>
        </div>
    </div>
</x-filament-panels::page>
