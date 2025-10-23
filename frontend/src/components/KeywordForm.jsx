import { useState } from "react";

export default function KeywordForm({ onSubmit }) {
  const [keywords, setKeywords] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    const list = keywords.split(",").map(k => k.trim()).filter(Boolean);
    onSubmit(list);
  };

  return (
    <form onSubmit={handleSubmit} className="p-6 bg-white rounded shadow-md w-full max-w-md mx-auto">
      <h2 className="text-2xl font-bold mb-4">Enter Keywords</h2>
      <textarea
        className="w-full border border-gray-300 rounded p-2 mb-4"
        rows="4"
        placeholder="Enter keywords separated by commas"
        value={keywords}
        onChange={(e) => setKeywords(e.target.value)}
      />
      <button
        type="submit"
        className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Cluster Keywords
      </button>
    </form>
  );
}
