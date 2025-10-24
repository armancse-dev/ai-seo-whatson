namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeywordClusterController extends Controller
{
    public function cluster(Request $request)
    {
        $keywords = $request->input('keywords', []);

        if (empty($keywords)) {
            return response()->json(['error' => 'No keywords provided'], 400);
        }

        return response()->json([
            'clusters' => [
                ['cluster_name' => 'Cluster 1', 'keywords' => $keywords],
            ],
        ]);
    }
}
