import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AuthenticatedLayout
            header={<h2 className="text-xl font-semibold text-white">หนังสือเริ่มต้น</h2>}
        >
            <Head title="Dashboard" />

            {/* 🔹 Navbar ด้านบน */}
            <div className="bg-pink-500 text-white p-4 flex justify-between items-center">
                <button className="text-white text-xl">🔍</button>
                <h2 className="text-lg font-semibold">หนังสือเริ่มต้น</h2>
                <Link href="/details" className="bg-white text-pink-500 px-3 py-1 rounded-lg shadow">
                    รายละเอียด
                </Link>
            </div>

            {/* 🔹 ส่วนสรุปยอดรายรับ-รายจ่าย */}
            <div className="p-4 bg-white mx-4 my-4 rounded-lg shadow-lg">
                <div className="flex justify-between text-lg">
                    <span className="text-red-500">-฿</span>
                    <span className="text-green-500">฿</span>
                    <span className="text-red-500">฿</span>
                </div>
                <div className="flex justify-between text-gray-500 text-sm">
                    <span>ทั้งหมด</span>
                    <span>รายได้</span>
                    <span>ค่าใช้จ่าย</span>
                </div>
            </div>

            {/* 🔹 แถบตัวเลือกการดูข้อมูล */}
            <div className="flex justify-around px-4 mt-2">
                <button className="text-gray-500">งบรายสัปดาห์</button>
                <button className="text-pink-500 border-b-2 border-pink-500 pb-1">งบรายเดือน</button>
                <button className="text-gray-500">งบประจำปี</button>
            </div>

            {/* 🔹 รายการธุรกรรมล่าสุด */}
            <div className="bg-white mx-4 my-4 p-4 rounded-lg shadow-lg">
                <h3 className="text-lg font-semibold text-gray-700">ส. 15/2</h3>
                <div className="mt-2">
                    <div className="flex justify-between items-center py-2 border-b">
                        <div className="flex items-center">
                            <span className="text-xl">🍔</span>
                            <div className="ml-3">
                                <p className="font-semibold text-gray-800">อาหาร</p>
                                <p className="text-gray-500 text-sm">ตัวฉันเอง / โกโก้</p>
                            </div>
                        </div>
                        <span className="text-red-500">-฿30</span>
                    </div>
                    <div className="flex justify-between items-center py-2 border-b">
                        <div className="flex items-center">
                            <span className="text-xl">🍔</span>
                            <div className="ml-3">
                                <p className="font-semibold text-gray-800">อาหาร</p>
                                <p className="text-gray-500 text-sm">ตัวฉันเอง / เซเว่น</p>
                            </div>
                        </div>
                        <span className="text-red-500">-฿103</span>
                    </div>
                </div>
            </div>

            {/* 🔹 Navbar ด้านล่าง */}
            <div className="fixed bottom-0 left-0 right-0 bg-white py-3 shadow-lg flex justify-around text-gray-500">
                <button className="text-pink-500 flex flex-col items-center">
                    📖<span className="text-sm">หนังสือ</span>
                </button>
                <button className="flex flex-col items-center">
                    💰<span className="text-sm">กระเป๋าเงิน</span>
                </button>
                <button className="flex flex-col items-center">
                    📊<span className="text-sm">การวิเคราะห์</span>
                </button>
                <button className="flex flex-col items-center">
                    ⚙️<span className="text-sm">เพิ่มเติม</span>
                </button>
            </div>

            {/* 🔹 Floating Button (ปุ่มลอย) สำหรับเพิ่มธุรกรรม */}
            <Link href="/transactions/add" className="fixed bottom-16 right-4 bg-yellow-500 p-4 rounded-full shadow-lg">
                ✏️
            </Link>
        </AuthenticatedLayout>
    );
}
