<?php
namespace App\Modules\WebhookIntegration\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class WebhookController extends Controller {
    public function index() {
        $webhooks = DB::table('webhooks')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(10);
        return view('webhook-integration.index', compact('webhooks'));
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'event' => 'required|in:lead.created,lead.updated,export.completed,report.ready',
        ]);
        DB::table('webhooks')->insert([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'url' => $validated['url'],
            'event' => $validated['event'],
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('webhooks.index')->with('success', 'Webhook erstellt!');
    }
    public function destroy($id) {
        DB::table('webhooks')->where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->route('webhooks.index')->with('success', 'Webhook gelöscht.');
    }
    public function test($id) {
        $webhook = DB::table('webhooks')->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$webhook) abort(404);
        try {
            $response = Http::timeout(10)->post($webhook->url, [
                'event' => $webhook->event . '.test',
                'message' => 'Test von Lead Finder Pro',
                'timestamp' => now()->toIso8601String(),
            ]);
            return redirect()->route('webhooks.index')->with('success', 'Test gesendet! Status: ' . $response->status());
        } catch (\Exception $e) {
            return redirect()->route('webhooks.index')->with('error', 'Fehler: ' . $e->getMessage());
        }
    }
    public function toggle($id) {
        $webhook = DB::table('webhooks')->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$webhook) abort(404);
        DB::table('webhooks')->where('id', $id)->update(['is_active' => !$webhook->is_active, 'updated_at' => now()]);
        return redirect()->route('webhooks.index');
    }
}
