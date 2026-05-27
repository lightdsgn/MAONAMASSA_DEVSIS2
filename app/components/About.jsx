import { ImageWithFallback } from "./figma/ImageWithFallback";
import aboutImage from "figma:asset/616defa5036dd0aeae623626a10b9df4dd16776e.png";
import { TEAM } from "../data/restaurantData";

export function About() {
  return (
    <section id="about" className="py-24 bg-[#0d0d0d]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Section label */}
        <p className="taro-subheading text-center mb-3">Náš příběh</p>
        <h2 className="text-4xl md:text-5xl taro-heading text-center mb-2">O nás</h2>
        <div className="taro-divider" />

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mt-8">
          {/* Image column */}
          <div className="relative">
            <div className="relative overflow-hidden rounded-lg shadow-2xl">
              <ImageWithFallback
                src={aboutImage}
                alt="Taro Restaurant Interior"
                className="w-full h-[520px] object-cover"
              />
              {/* Red accent overlay strip */}
              <div className="absolute left-0 top-0 bottom-0 w-1 bg-[#C8102E]" />
            </div>
            {/* Floating card */}
            <div className="absolute -bottom-6 -right-6 bg-[#C8102E] text-white p-8 rounded-lg shadow-2xl max-w-[240px]">
              <p className="text-3xl mb-1 tracking-wide">Taste</p>
              <p className="text-sm leading-relaxed opacity-90">
                Vietnamská tradice v moderním pojetí
              </p>
            </div>
          </div>

          {/* Content column */}
          <div className="lg:pl-4">
            <p className="text-gray-400 text-lg leading-relaxed mb-10">
              Jsme Khanh a Giang, dva bratři s vietnamskými kořeny, kteří od narození žijí v České
              republice. V Taru jsme sestavili tým kreativců, profesionálů a kulinářských rebelů,
              kteří s námi sdílejí neutuchající vášeň pro skvělé jídlo a pití.
            </p>

            <div className="space-y-8">
              {TEAM.map((member) => (
                <div
                  key={member.name}
                  className="taro-card p-6"
                >
                  <div className="flex items-center gap-3 mb-3">
                    <div className="w-1 h-8 bg-[#C8102E] rounded-full" />
                    <div>
                      <h3 className="text-xl text-white">{member.name}</h3>
                      <span className="taro-subheading">{member.role}</span>
                    </div>
                  </div>
                  <p className="text-gray-400 italic mb-2 leading-relaxed">
                    "{member.quote}"
                  </p>
                  <p className="text-gray-500 text-sm">{member.description}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
