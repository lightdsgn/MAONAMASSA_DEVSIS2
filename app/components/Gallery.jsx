import { useState } from "react";
import { X } from "lucide-react";
import { ImageWithFallback } from "./figma/ImageWithFallback";
import foodImage from "figma:asset/95c942d9e03f96d9e788775a0ef3f808ea79a2ac.png";
import interiorDark from "figma:asset/f919b6432b2c22b275e169f31c7893d18c48b34d.png";
import barInterior from "figma:asset/e915cf1c3f524dabc267b9bc0b78fdb5174a25a5.png";
import dessertImage from "figma:asset/33d875195b61e8b664977b9fbd6fc4c3c0f2a0ae.png";

const galleryImages = [
  { url: foodImage,      alt: "Vietnamské speciality",   label: "Kuchyně" },
  { url: interiorDark,   alt: "Interiér restaurace",     label: "Interiér" },
  { url: barInterior,    alt: "Bar a otevřená kuchyně",  label: "Bar" },
  { url: dessertImage,   alt: "Dezerty",                 label: "Dezerty" },
];

export function Gallery() {
  const [lightbox, setLightbox] = useState(null); // index or null

  return (
    <section id="gallery" className="py-24 bg-[#0d0d0d]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Header */}
        <p className="taro-subheading text-center mb-3">Atmosféra &amp; Chutě</p>
        <h2 className="text-4xl md:text-5xl taro-heading text-center mb-2">Galerie</h2>
        <div className="taro-divider" />
        <p className="text-lg text-gray-400 max-w-2xl mx-auto text-center mb-16">
          Nahlédněte do našeho světa chutí a atmosféry
        </p>

        {/* Gallery Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          {galleryImages.map((image, index) => (
            <button
              key={index}
              className="taro-gallery-item relative h-80 block cursor-pointer group border border-white/5 w-full text-left"
              onClick={() => setLightbox(index)}
              aria-label={`Zobrazit: ${image.alt}`}
            >
              <ImageWithFallback
                src={image.url}
                alt={image.alt}
                className="w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300" />
              {/* Label on hover */}
              <div className="absolute bottom-0 left-0 right-0 p-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                <p className="taro-subheading">{image.label}</p>
              </div>
              {/* Red left border */}
              <div className="absolute left-0 top-0 bottom-0 w-0 group-hover:w-1 bg-[#C8102E] transition-all duration-300" />
            </button>
          ))}
        </div>
      </div>

      {/* Lightbox */}
      {lightbox !== null && (
        <div
          className="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
          onClick={() => setLightbox(null)}
        >
          <button
            className="absolute top-6 right-6 text-white/70 hover:text-white transition-colors"
            aria-label="Zavřít"
          >
            <X size={32} />
          </button>
          <img
            src={galleryImages[lightbox].url}
            alt={galleryImages[lightbox].alt}
            className="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl"
            onClick={(e) => e.stopPropagation()}
          />
          <p className="absolute bottom-8 left-1/2 -translate-x-1/2 taro-subheading">
            {galleryImages[lightbox].label}
          </p>
        </div>
      )}
    </section>
  );
}
