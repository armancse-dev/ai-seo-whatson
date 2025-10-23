import { useState } from "react";

export default function KeywordForm({ onSubmit }) {
  const [keywords, setKeywords] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    const list = keywords
      .split(",")
      .map((k) => k.trim())
      .filter(Boolean);

    if (list.length === 0) return;
    onSubmit(list);
  };

  return (
    <form
      onSubmit={handleSubmit}
      className="bg-white shadow-lg rounded-2xl p-6 w-full max-w-lg"
    >
      <label className="block text-gray-700 font-semibold mb-2">
        Enter Keywords (comma separated)
      </label>

      <textarea
        value={keywords}
        onChange={(e) => setKeywords(e.target.value)}
        rows="4"
        placeholder="Example: best seo tools, keyword research, ai seo..."
        className="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 mb-4"
      />

      <button
        type="submit"
        className="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition"
      >
         Generate Clusters
      </button>
    </form>
  );
}
