import { useState } from "react";

export default function KeywordForm({ onSubmit }) {
  const [keywords, setKeywords] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault(); // 🚫 Prevents default GET reload

    const keywordArray = keywords
      .split("\n")
      .map((kw) => kw.trim())
      .filter((kw) => kw.length > 0);

    if (keywordArray.length === 0) {
      alert("Please enter at least one keyword!");
      return;
    }

    onSubmit(keywordArray);
  };

  return (
    <form
      onSubmit={handleSubmit}
      className="w-full max-w-md bg-white p-6 rounded-xl shadow-md"
    >
      <textarea
        className="w-full border border-gray-300 rounded p-3 focus:ring-2 focus:ring-blue-400"
        rows="6"
        placeholder="Enter one keyword per line..."
        value={keywords}
        onChange={(e) => setKeywords(e.target.value)}
      />

      <button
        type="submit"
        className="mt-4 w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition"
      >
        Generate Cluster
      </button>
    </form>
  );
}
