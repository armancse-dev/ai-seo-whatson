import { useEffect, useState } from "react";
import api from "./api";

function App() {
  const [data, setData] = useState([]);

  useEffect(() => {
    api.get("/test").then((res) => {
      setData(res.data);
    }).catch((err) => {
      console.error("API Error:", err);
    });
  }, []);

  return (
    <div style={{ padding: "2rem", fontFamily: "Arial" }}>
      <h1 className="text-4xl font-bold text-blue-600">Tailwind is working!</h1>


    
    </div>
  );
}

export default App;
