import { useState } from "react";
import KeywordForm from "./components/KeywordForm";

export default function App() {
  const [clusters, setClusters] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const handleSubmit = async (keywords) => {
    setLoading(true);
    setError("");
    setClusters([]);

    try {
      const res = await fetch("http://127.0.0.1:8000/api/cluster", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ keywords }),
      });

      if (!res.ok) {
        throw new Error("Failed to fetch clustering data");
      }

      const data = await res.json();
      setClusters(data.clusters || []);
    } catch (err) {
      setError(err.message || "Something went wrong");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center p-6">
      <h1 className="text-3xl md:text-4xl font-extrabold text-blue-700 mb-8">
        AI SEO Keyword Cluster Tool
      </h1>

      <KeywordForm onSubmit={handleSubmit} />

      {loading && (
        <div className="mt-8 text-lg text-gray-600 animate-pulse">
          Clustering keywords... please wait
        </div>
      )}

      {error && (
        <div className="mt-8 text-red-600 bg-red-100 px-4 py-2 rounded">
          {error}
        </div>
      )}

      {clusters.length > 0 && (
        <div className="mt-10 w-full max-w-2xl">
          <h3 className="text-xl font-bold mb-4 text-gray-800">
            Cluster Results
          </h3>

          <div className="grid gap-4">
            {clusters.map((cluster, idx) => (
              <div
                key={idx}
                className="p-5 bg-white rounded-xl shadow hover:shadow-lg transition"
              >
                <h4 className="font-semibold text-blue-600 text-lg mb-2">
                  {cluster.cluster_name}
                </h4>
                <ul className="list-disc list-inside space-y-1 text-gray-700">
                  {cluster.keywords.map((kw, i) => (
                    <li key={i}>{kw}</li>
                  ))}
                </ul>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
