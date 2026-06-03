<?php

namespace App\Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    /**
     * Get all notifications for the current user.
     */
    private function getNotifications(): array
    {
        $user = Auth::id();
        return [
            [
                'id' => 1,
                'type' => 'lead',
                'title' => 'Neue Leads gefunden',
                'message' => '15 neue Leads in "Restaurants Berlin" gefunden.',
                'icon' => 'fa-users',
                'color' => 'text-green-500',
                'bg' => 'bg-green-50',
                'read' => false,
                'created_at' => now()->subMinutes(5),
            ],
            [
                'id' => 2,
                'type' => 'export',
                'title' => 'Export abgeschlossen',
                'message' => 'CSV-Export (247 Leads) wurde erfolgreich erstellt.',
                'icon' => 'fa-file-csv',
                'color' => 'text-blue-500',
                'bg' => 'bg-blue-50',
                'read' => false,
                'created_at' => now()->subHours(1),
            ],
            [
                'id' => 3,
                'type' => 'enrichment',
                'title' => 'Enrichment fertig',
                'message' => '8 Leads wurden erfolgreich angereichert.',
                'icon' => 'fa-wand-magic-sparkles',
                'color' => 'text-purple-500',
                'bg' => 'bg-purple-50',
                'read' => true,
                'created_at' => now()->subHours(3),
            ],
            [
                'id' => 4,
                'type' => 'system',
                'title' => 'System-Update verfügbar',
                'message' => 'Lead Finder Pro v3.1 ist jetzt verfügbar.',
                'icon' => 'fa-rocket',
                'color' => 'text-orange-500',
                'bg' => 'bg-orange-50',
                'read' => true,
                'created_at' => now()->subDay(),
            ],
        ];
    }

    public function index()
    {
        $notifications = $this->getNotifications();
        return view('modules.notifications.index', compact('notifications'));
    }

    public function feed()
    {
        $notifications = $this->getNotifications();
        $unreadCount = collect($notifications)->where('read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function markAsRead(Request $notification)
    {
        // In production: mark notification as read in database
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        // In production: mark all notifications as read
        return response()->json(['success' => true]);
    }

    public function destroy($notification)
    {
        // In production: delete notification from database
        return response()->json(['success' => true]);
    }
}
