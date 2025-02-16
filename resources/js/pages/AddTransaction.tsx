import { useState } from "react";
import { router } from "@inertiajs/react";

const categories = [
    { id: 1, name: "อาหาร", icon: "🍔" },
    { id: 2, name: "รายวัน", icon: "☕" },
    { id: 3, name: "การจราจร", icon: "🚌" },
    { id: 4, name: "ทางสังคม", icon: "🥂" },
    { id: 5, name: "ที่อยู่อาศัย", icon: "🏡" },
    { id: 6, name: "ของขวัญ", icon: "🎁" },
    { id: 7, name: "สื่อสาร", icon: "📱" },
    { id: 8, name: "เสื้อผ้า", icon: "👗" },
];

const AddTransaction = () => {
    const [amount, setAmount] = useState("");
    const [category, setCategory] = useState(categories[0].id);

    const handleNumberPress = (num: string) => {
        setAmount((prev) => prev + num);
    };

    const handleDelete = () => {
        setAmount((prev) => prev.slice(0, -1));
    };

    const handleSubmit = () => {
        router.post("/transactions", { category_id: category, amount });
    };

    return (
        <div className="min-h-screen bg-pink-100">
            {/* 🔹 Navbar ด้านบน */}
            <div className="bg-pink-600 text-white p-4 flex justify-between items-center">
                <button onClick={() => history.back()} className="text-xl">❌</button>
                <h2 className="text-lg font-semibold">ค่าใช้จ่าย</h2>
                <button onClick={handleSubmit} className="text-xl">✔️</button>
            </div>

            {/* 🔹 เลือกหมวดหมู่ */}
            <div className="bg-white p-4 rounded-lg shadow mx-4 mt-4">
                <div className="grid grid-cols-4 gap-4">
                    {categories.map((cat) => (
                        <button
                            key={cat.id}
                            onClick={() => setCategory(cat.id)}
                            className={`p-3 rounded-lg shadow text-center ${
                                category === cat.id ? "bg-pink-300 text-white" : "bg-gray-100 text-gray-700"
                            }`}
                        >
                            <span className="text-2xl">{cat.icon}</span>
                            <p className="text-sm mt-1">{cat.name}</p>
                        </button>
                    ))}
                </div>
            </div>

            {/* 🔹 คีย์แพดสำหรับใส่จำนวนเงิน */}
            <div className="bg-pink-500 text-white p-6 mt-6 rounded-t-lg">
                <input
                    type="text"
                    value={amount}
                    readOnly
                    className="w-full text-3xl text-center bg-transparent focus:outline-none"
                />

                <div className="grid grid-cols-4 gap-3 mt-4">
                    {["7", "8", "9", "x", "4", "5", "6", "/", "1", "2", "3", "-", ".", "0", "✅", "+"].map((key) => (
                        <button
                            key={key}
                            onClick={() => (key === "✅" ? handleSubmit() : handleNumberPress(key))}
                            className={`p-4 rounded-lg text-2xl ${
                                key === "✅" ? "bg-green-400" : "bg-pink-300"
                            } shadow-lg`}
                        >
                            {key}
                        </button>
                    ))}
                    <button onClick={handleDelete} className="col-span-4 p-4 bg-red-400 rounded-lg text-2xl shadow-lg">
                        ❌ ลบ
                    </button>
                </div>
            </div>
        </div>
    );
};

export default AddTransaction;  
