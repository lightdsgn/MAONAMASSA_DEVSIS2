import { Navigation } from "./components/Navigation";
import { Hero } from "./components/Hero";
import { About } from "./components/About";
import { Menu } from "./components/Menu";
import { Gallery } from "./components/Gallery";
import { Vouchers } from "./components/Vouchers";
import { Contact } from "./components/Contact";
import { Footer } from "./components/Footer";

export default function App() {
  return (
    <div className="size-full bg-black">
      <Navigation />
      <Hero />
      <About />
      <Menu />
      <Gallery />
      <Vouchers />
      <Contact />
      <Footer />
    </div>
  );
}
