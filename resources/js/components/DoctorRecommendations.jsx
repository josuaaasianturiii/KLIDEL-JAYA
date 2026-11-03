import React, { useState } from 'react';

/**
 * Data Default Rekomendasi Dokter
 */
const DEFAULT_DOCTORS = [
  {
    id: 1,
    name: 'Dr. Lina Wijaya',
    specialty: 'Cardiologist',
    rating: 4.9,
    price: '$16.5',
    slots: '4 Slots Available',
    image: '/images/doctors/doctor-1.png',
    alt: 'Dr. Lina Wijaya - Cardiologist',
  },
  {
    id: 2,
    name: 'Dr. Anaya Kapoor',
    specialty: 'Neurologist',
    rating: 4.8,
    price: '$18.0',
    slots: '6 Slots Available',
    image: '/images/doctors/doctor-2.png',
    alt: 'Dr. Anaya Kapoor - Neurologist',
  },
  {
    id: 3,
    name: 'Dr. Saran Mitchell',
    specialty: 'Orthopedist',
    rating: 4.7,
    price: '$19.0',
    slots: '5 Slots Available',
    image: '/images/doctors/doctor-3.png',
    alt: 'Dr. Saran Mitchell - Orthopedist',
  },
];

/**
 * Komponen Kartu Rekomendasi Dokter dengan Out of Bounds (Pop-out Effect)
 *
 * Efek Kedalaman Spasial (Pop-out 3D):
 * 1. Elemen Foto Dokter memotong dan menembus batas atas kartu (-top-7, h-[126%], z-20)
 *    dengan bayangan drop-shadow realistis yang jatuh di atas permukaan kartu.
 * 2. Ikon 3D Mikroskop melayang di sudut kanan atas (-top-7 -right-2, z-30), sebagian berada
 *    di luar batas tepi kartu untuk menciptakan efek keluar layar.
 * 3. Ikon 3D Stetoskop & Hati pastel melayang di lapisan background memberi ilusi dimensi bertingkat.
 * 4. Kartu ke-3 (Dr. Saran Mitchell) default terpilih (active border-2 border-teal-700).
 */
export default function DoctorRecommendations({
  doctors = DEFAULT_DOCTORS,
  selectedId: controlledSelectedId,
  onSelectDoctor,
}) {
  // Status default kartu ke-3 (Dr. Saran Mitchell, id: 3) aktif
  const [internalSelectedId, setInternalSelectedId] = useState(3);

  const activeId = controlledSelectedId !== undefined ? controlledSelectedId : internalSelectedId;

  const handleSelect = (doctor) => {
    if (controlledSelectedId === undefined) {
      setInternalSelectedId(doctor.id);
    }
    if (onSelectDoctor) {
      onSelectDoctor(doctor);
    }
  };

  return (
    <div className="w-full max-w-5xl mx-auto pt-10 pb-6 px-2">
      {/* Grid Layout dengan headroom cukup untuk efek pop-out */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {doctors.map((doc) => {
          const isSelected = activeId === doc.id;

          return (
            <button
              key={doc.id}
              type="button"
              onClick={() => handleSelect(doc)}
              aria-pressed={isSelected}
              className={`group relative flex flex-col w-full text-left bg-white rounded-3xl transition-all duration-300 ease-out cursor-pointer focus:outline-none overflow-visible ${
                isSelected
                  ? 'border-2 border-teal-700 shadow-lg ring-4 ring-teal-700/15 -translate-y-1.5'
                  : 'border-2 border-transparent shadow-sm hover:shadow-xl hover:border-slate-200 hover:-translate-y-2'
              }`}
            >
              {/* 3D Floating Microscope (Out-of-Bounds Pop-out di Pojok Kanan Atas) */}
              <div className="absolute -top-7 -right-2 w-16 h-16 sm:w-20 sm:h-20 z-30 pointer-events-none transition-transform duration-300 ease-out group-hover:scale-110 group-hover:-rotate-6 drop-shadow-[0_8px_16px_rgba(0,0,0,0.12)]">
                <img
                  src="/images/3d/microscope.png"
                  alt="3D Microscope"
                  className="w-full h-full object-contain pointer-events-none"
                  loading="lazy"
                />
              </div>

              {/* 3D Floating Stethoscope with Heart (Kedalaman Spasial di Background) */}
              <div className="absolute top-12 left-3 w-14 h-14 sm:w-16 sm:h-16 z-0 pointer-events-none opacity-20 -rotate-12 transition-transform duration-500 ease-out group-hover:rotate-0 group-hover:scale-105">
                <img
                  src="/images/3d/stethoscope.png"
                  alt="3D Stethoscope"
                  className="w-full h-full object-contain pointer-events-none"
                  loading="lazy"
                />
              </div>

              {/* Blok Atas Hijau Pastel (rounded-t-[22px], overflow-visible untuk pop-out) */}
              <div className="relative w-full h-48 sm:h-52 bg-teal-50/90 rounded-t-[22px] flex items-end justify-center overflow-visible">
                {/* Badge Rating Pil (Pojok Kiri Atas) */}
                <div className="absolute top-3.5 left-3.5 z-30 inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-xs px-2.5 py-1 rounded-full shadow-xs border border-slate-100">
                  <svg
                    className="w-3.5 h-3.5 text-amber-400 fill-amber-400"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  <span className="text-xs font-bold text-slate-900 leading-none">
                    {Number(doc.rating).toFixed(1)}
                  </span>
                </div>

                {/* Foto Dokter Cut-Out (Pop-out Menembus Batas Atas Kartu) */}
                <div className="relative w-full h-full flex items-end justify-center overflow-visible">
                  <img
                    src={doc.image}
                    alt={doc.alt || doc.name}
                    className="relative z-20 h-[126%] w-auto max-w-none object-contain object-bottom -top-6 sm:-top-7 pointer-events-none transition-transform duration-300 ease-out group-hover:scale-108 group-hover:-translate-y-2 drop-shadow-[0_14px_20px_rgba(15,118,110,0.22)]"
                    loading="lazy"
                  />
                </div>
              </div>

              {/* Bagian Bawah: Informasi Detail Dokter (Background Putih, rounded-b-[22px]) */}
              <div className="relative z-20 p-5 flex flex-col flex-1 justify-between bg-white rounded-b-[22px] text-left">
                <div>
                  {/* Nama Dokter */}
                  <h3 className="text-lg font-bold text-slate-900 truncate tracking-tight">
                    {doc.name}
                  </h3>

                  {/* Spesialisasi */}
                  <p className="text-sm font-normal text-slate-500 truncate mt-0.5">
                    {doc.specialty}
                  </p>

                  {/* Pill Slot / Jadwal Tersedia */}
                  <span className="inline-flex items-center gap-1.5 text-[11px] font-semibold text-teal-800 bg-teal-50 px-2.5 py-0.5 rounded-full mt-2.5">
                    <span className="w-1.5 h-1.5 rounded-full bg-teal-600 animate-pulse"></span>
                    {doc.slots || '5 Slots Available'}
                  </span>
                </div>

                {/* Harga per sesi */}
                <div className="mt-4 flex items-baseline gap-1">
                  <span className="text-base font-bold text-teal-700">
                    {doc.price}
                  </span>
                  <span className="text-xs font-normal text-slate-400">
                    /per session
                  </span>
                </div>
              </div>
            </button>
          );
        })}
      </div>
    </div>
  );
}
