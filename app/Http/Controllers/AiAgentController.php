<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiAgentController extends Controller
{
    public function index()
    {
        return view('farmer.ai.index');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $userMessage = strtolower($request->message);
        
        // Simulated AI Responses
        // In a real scenario, this would call an API like OpenAI or Gemini
        $reply = "I'm analyzing your request...";

        if (str_contains($userMessage, 'weather') || str_contains($userMessage, 'rain')) {
            $reply = "Based on the upcoming forecast, we expect rain on Wednesday. It is highly advised to avoid spraying pesticides or insecticides until Thursday to prevent runoff.";
        } elseif (str_contains($userMessage, 'pesticide') || str_contains($userMessage, 'insecticide') || str_contains($userMessage, 'pest')) {
            $reply = "For pest control on your current crops, ensure you are using the designated dosage. For cotton, consider using Neem-based biopesticides to prevent bollworm infestations. Always wear protective gear.";
        } elseif (str_contains($userMessage, 'crop') || str_contains($userMessage, 'yield')) {
            $reply = "To maximize your yield with Black Soil, consider rotating your crops with legumes like soybeans next season. This will naturally replenish nitrogen levels in the soil.";
        } elseif (str_contains($userMessage, 'mandi') || str_contains($userMessage, 'price')) {
            $reply = "Currently, Wheat and Paddy prices are trending upwards. If you are planning to harvest soon, holding for a week might net you a 1-2% better margin based on current market trends.";
        } else {
            $reply = "That's an excellent question. As your AI Agronomist, I recommend regularly testing your soil pH. Can I help you with specific crop rotations, market timings, or pesticide schedules?";
        }

        // Simulate network delay for realism
        sleep(1);

        return response()->json([
            'reply' => $reply
        ]);
    }
}
