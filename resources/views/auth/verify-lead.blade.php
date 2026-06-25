<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email bestätigen — LeadFinderPro</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <nav class="border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-14 items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="text-lg font-semibold text-gray-900">LeadFinderPro</span>
            </a>
        </div>
    </nav>

    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-6">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-3">Email-Adresse bestätigen</h1>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-4 text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-4 text-sm">
                {{ session('error') }}
            </div>
            @endif

            <p class="text-gray-600 mb-6">
                Wir haben einen Verifizierungslink an <strong>{{ $lead->email }}</strong> gesendet.
                Bitte prüfen Sie Ihren Posteingang und klicken Sie auf den Link, um Ihren Lead-Report zu erhalten.
            </p>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-600 mb-6">
                <p class="font-medium text-gray-700 mb-2">Keine Email erhalten?</p>
                <ul class="text-left space-y-1">
                    <li>• Prüfen Sie Ihren Spam-Ordner</li>
                    <li>• Warten Sie bis zu 5 Minuten</li>
                    <li>• Fordern Sie den Link erneut an:</li>
                </ul>
            </div>

            <form action="{{ route('lead.verification.resend') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="email" value="{{ $lead->email }}">
                <button type="submit" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium underline">
                    Verifizierungslink erneut senden
                </button>
            </form>
        </div>
    </div>

    <footer class="border-t border-gray-200 py-8 mt-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <p class="text-sm text-gray-500">© {{ date('Y') }} LeadFinderPro. Ein Projekt von CreativeCodingSolutions.</p>
                <div class="flex gap-6 text-sm text-gray-500">
                    <a href="/datenschutz" class="hover:text-gray-900">Datenschutz</a>
                    <a href="/impressum" class="hover:text-gray-900">Impressum</a>
                    <a href="/agb" class="hover:text-gray-900">AGB</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
