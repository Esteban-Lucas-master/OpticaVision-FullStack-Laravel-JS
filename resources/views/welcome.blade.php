<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Óptica Vision - Catálogo de Productos</title>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        />
        <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body>
        <!-- NAV -->
        <nav class="navbar">
    <div class="nav-container">
        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-glasses"></i>
        </div>

        <!-- Nombre del usuario -->
        @auth
        <h2><span class="user-name">{{ Auth::user()->name }}</span></h2>
        @endauth

        <!-- Botón hamburguesa -->
        <button class="hamburger" id="hamburger">
            ☰
        </button>

        <!-- Menú -->
        <ul class="menu" id="menu">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#productos">Productos</a></li>
            <li><a href="#ofertas">Ofertas</a></li>
            <li><a href="#servicios">Servicios</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#testimonios">Testimonios</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>

        <!-- Links derecha -->
        <div class="top-right links">
            @guest
            <a href="{{ route('login') }}" style="margin-top: 15px">Log in</a>
            <a href="{{ route('register') }}" style="margin-top: 15px">Register</a>
            @endguest 

            @auth
            <!-- Notificaciones -->
            <div style="display: inline-block; position: relative">
                <button id="btnNotifications" style="font-size: 20px; background: none; border: none; cursor: pointer;">
                    🔔
                    <span id="notificationBadge"></span>
                </button>
                <div id="notificationsBox"
                    style="display: none; position: absolute; top: 30px; right: 0; background: white; border: 1px solid #ddd; padding: 10px; width: 280px; margin-top: 12px;">
                    <p><strong>Últimas compras actualizadas:</strong></p>
                    <ul id="notificationsList"></ul>
                </div>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline">
                @csrf
                <button type="submit" 
                    style="background-color: rgb(237, 66, 66); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; transition: all 0.2s ease; margin-top: 12px;"
                    onmouseover="this.style.backgroundColor='#cc0000'; this.style.transform='scale(0.95)';"
                    onmouseout="this.style.backgroundColor='rgb(237, 66, 66)'; this.style.transform='scale(1)';">
                    Cerrar sesión
                </button>
            </form>
            @endauth
        </div>
    </div>
</nav>


        <!-- SECCIÓN INICIO -->

<section id="inicio" style="text-align: center; padding: 60px 20px; position: relative; z-index: 10;">
    <h1 style="font-size: 40px; margin-bottom: 20px;">Óptica Vision Perfecta</h1>
    <p style="max-width: 600px; margin: 0 auto 30px auto; font-size: 18px; line-height: 1.5;">
        Especialistas en salud visual con más de 20 años de experiencia. 
        Ofrecemos soluciones ópticas personalizadas con la más alta tecnología 
        y atención profesional.
    </p>

    <!-- BUSCADOR DENTRO DE INICIO -->
    <form id="searchForm" style="display:inline-block; width: 60%; max-width: 500px; position: relative; z-index: 20;">
        <input type="text" id="searchInput" placeholder="Buscar producto..." 
               style="width: 70%; padding: 12px; border:1px solid #ccc; border-radius: 8px 0 0 8px; outline:none; position: relative; z-index: 30; background:white;">
        <button type="submit" 
                style="padding: 12px 20px; background:#1078b9; color:white; border:none; border-radius:0 8px 8px 0; cursor:pointer; position: relative; z-index: 30;">
            Buscar
        </button>
    </form>
</section>


        <main>

    {{-- Usamos la clase .card-container para el div que envuelve los productos --}}
   <section id="productos">
<center><h1 style="font-size: 40px">Productos</h1></center>

    <div class="swiper products-carousel">
        <div class="swiper-wrapper">
            
            @foreach($products as $product)
                <div class="swiper-slide">
                    
                    {{-- Reutilizamos el diseño de .card que ya teníamos --}}
                    <div class="card">
                        @if($product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" />
                        @endif
                        
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>

                        @if($product->on_offer)
                            <p class="offer-price">¡En oferta!</p>
                        @endif
                        
                        <p style="color: #10b981">Precio: ${{ number_format($product->price, 0, ',', '.') }}</p>

                        <a href="{{ route('products.show', $product->id) }}">
                            <button>Ver más</button>
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
        
        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

{{-- DEBES HACER LO MISMO PARA LA SECCIÓN DE OFERTAS --}}
{{-- Simplemente cambia el nombre de la clase del contenedor, por ejemplo a "offers-carousel" --}}
</section>

            <!-- SECCIÓN OFERTAS - Solo agregando clases CSS -->
            <!-- SECCIÓN OFERTAS -->
<section id="ofertas" class="card-section offers-section">
    <h2>Ofertas especiales</h2>

    @if($offers->isEmpty())
        <p>No hay productos en oferta actualmente.</p>
    @else
        <div class="swiper offers-carousel">
            <div class="swiper-wrapper">
                @foreach($offers as $product)
                    <div class="swiper-slide">
                        <div class="card">
                            @if($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" />
                            @endif

                            <h3>{{ $product->name }}</h3>
                            <p>{{ $product->description }}</p>

                            {{-- Usamos la clase para destacar la oferta --}}
                            <p class="offer-price">¡Precio especial!</p>

                            <p style="color: #10b981">Precio: ${{ number_format($product->price, 0, ',', '.') }}</p>

                            <a href="{{ route('products.show', $product->id) }}">
                                <button>Ver más</button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles de navegación -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @endif
</section>


            <!-- SECCIÓN SERVICIOS -->
            <section id="servicios" class="section-container fade-in">
                <h2 class="section-title">Nuestros Servicios Profesionales</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <i class="fas fa-eye"></i>
                        <h3>Examen Visual Completo</h3>
                        <p>
                            Evaluaciones profesionales con equipos de última
                            generación para detectar problemas visuales y
                            enfermedades oculares.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-glasses"></i>
                        <h3>Lentes Oftálmicos</h3>
                        <p>
                            Amplio catálogo de lentes con tratamientos
                            antirreflejante, fotocromáticos y progresivos de las
                            mejores marcas.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-sun"></i>
                        <h3>Lentes de Sol</h3>
                        <p>
                            Protección UV completa con diseños modernos y
                            graduaciones personalizadas para cada necesidad.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-tools"></i>
                        <h3>Reparaciones</h3>
                        <p>
                            Servicio técnico especializado en reparación y
                            ajuste de monturas con garantía de calidad.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-shipping-fast"></i>
                        <h3>Entrega Express</h3>
                        <p>
                            Servicio de entrega rápida para que tengas tus
                            lentes listos en el menor tiempo posible.
                        </p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-certificate"></i>
                        <h3>Garantía Extendida</h3>
                        <p>
                            Respaldo completo en todos nuestros productos con
                            política de cambio y satisfacción garantizada.
                        </p>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN NOSOTROS -->
            <section id="nosotros" class="section-container fade-in">
                <h2 class="section-title">Acerca de Nosotros</h2>
                <div class="about-content">
                    <p>
                        Con más de dos décadas de experiencia en el sector
                        óptico, Óptica Vision se ha consolidado como líder en el
                        cuidado de la salud visual. Contamos con un equipo de
                        profesionales especializados y tecnología de vanguardia
                        para ofrecerte soluciones ópticas personalizadas que se
                        adapten perfectamente a tu estilo de vida.
                    </p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <i class="fas fa-users"></i>
                            <h3>25,000+</h3>
                            <p>Clientes Satisfechos</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-award"></i>
                            <h3>20+</h3>
                            <p>Años de Experiencia</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <h3>1,200+</h3>
                            <p>Modelos Disponibles</p>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <h3>4.9/5</h3>
                            <p>Calificación Promedio</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN TESTIMONIOS -->
            <section id="testimonios" class="section-container fade-in">
                <h2 class="section-title">Testimonios de Nuestros Clientes</h2>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <p>
                            "Excelente atención profesional y productos de la
                            más alta calidad. El equipo es muy conocedor y me
                            ayudaron a encontrar exactamente lo que necesitaba
                            para mi problema visual específico."
                        </p>
                        <h4>— Dr. María González, Médica</h4>
                    </div>
                    <div class="testimonial-card">
                        <p>
                            "El servicio es impecable, desde el examen visual
                            hasta la entrega de los lentes. La calidad de las
                            monturas y cristales es excepcional. Definitivamente
                            mi óptica de confianza."
                        </p>
                        <h4>— Carlos Rodríguez, Ingeniero</h4>
                    </div>
                    <div class="testimonial-card">
                        <p>
                            "Profesionales altamente capacitados y tecnología de
                            punta. Los lentes progresivos que me fabricaron son
                            perfectos. La adaptación fue muy rápida y cómoda."
                        </p>
                        <h4>— Ana López, Arquitecta</h4>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN FAQ -->
            <section id="faq" class="section-container fade-in">
                <h2 class="section-title">Preguntas Frecuentes</h2>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Cómo puedo agendar un examen visual?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Puedes agendar tu cita llamando a nuestro número
                                telefónico, visitando nuestra tienda física, o a
                                través de nuestro sistema de citas online.
                                Recomendamos agendar con anticipación para
                                garantizar disponibilidad en el horario de tu
                                preferencia.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Qué métodos de pago aceptan?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Aceptamos efectivo, tarjetas de crédito y débito
                                de todas las franquicias, transferencias
                                bancarias, y ofrecemos planes de financiamiento
                                sin intereses hasta 12 meses para compras
                                superiores a cierto monto.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Cuál es la garantía de los productos?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Ofrecemos garantía completa: 2 años en monturas
                                contra defectos de fabricación, 1 año en
                                cristales oftálmicos, y 6 meses en lentes de
                                contacto. Adicionalmente, incluimos ajustes
                                gratuitos durante el primer año.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span
                                >¿Cuánto tiempo tardan en fabricar los
                                lentes?</span
                            >
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Los tiempos varían según el tipo de lente:
                                cristales simples 24-48 horas, bifocales y
                                antirreflejantes 3-5 días hábiles, progresivos
                                de alta gama 7-10 días hábiles. Para casos
                                urgentes, ofrecemos servicio express con costo
                                adicional.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>¿Realizan reparaciones de monturas?</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Sí, contamos con taller especializado para
                                reparaciones. Soldadura de monturas metálicas,
                                cambio de plaquetas nasales, ajuste de patillas,
                                y reparaciones menores. La mayoría se realizan
                                mientras esperas.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN SUSCRIPCIÓN -->
            <section id="suscripcion" class="fade-in">
                <div class="subscription-section">
                    <h2>Mantente Informado</h2>
                    <p>
                        Suscríbete a nuestro newsletter para recibir ofertas
                        exclusivas, consejos de salud visual, información sobre
                        nuevos productos y promociones especiales para clientes
                        VIP.
                    </p>
                    <form class="form-container">
                        <input
                            type="email"
                            placeholder="Ingresa tu correo electrónico"
                            required
                        />
                        <button type="submit">Suscribirse</button>
                    </form>
                </div>
            </section>

            <!-- SECCIÓN CONTACTO -->
            <section id="contacto" class="section-container fade-in">
                <h2 class="section-title">Información de Contacto</h2>
                <div class="contact-grid">
                    <div class="contact-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Ubicación</h3>
                        <p>
                            Av. Principal #123<br />Centro Comercial Plaza
                            Mayor<br />Piso 2, Local 205<br />Turbána, Bolívar
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-phone"></i>
                        <h3>Teléfonos</h3>
                        <p>
                            Fijo: (605) 123-4567<br />Móvil: (301) 234-5678<br />WhatsApp:
                            (320) 345-6789
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>
                            info@opticavision.co<br />ventas@opticavision.co<br />citas@opticavision.co
                        </p>
                    </div>
                    <div class="contact-card">
                        <i class="fas fa-clock"></i>
                        <h3>Horarios de Atención</h3>
                        <p>
                            Lunes a Viernes: 8:00 AM - 6:00 PM<br />Sábados:
                            8:00 AM - 4:00 PM<br />Domingos: 10:00 AM - 2:00 PM
                        </p>
                    </div>
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer>
            <div class="footer-content">
                <div class="footer-links">
                    <a href="#inicio">Inicio</a>
                    <a href="#productos">Productos</a>
                    <a href="#ofertas">Ofertas</a>
                    <a href="#servicios">Servicios</a>
                    <a href="#nosotros">Nosotros</a>
                    <a href="#testimonios">Testimonios</a>
                    <a href="#faq">FAQ</a>
                    <a href="#contacto">Contacto</a>
                </div>

                <div class="social-links">
                    <a href="#" title="Facebook"
                        ><i class="fab fa-facebook-f"></i
                    ></a>
                    <a href="#" title="Instagram"
                        ><i class="fab fa-instagram"></i
                    ></a>
                    <a href="#" title="Twitter"
                        ><i class="fab fa-twitter"></i
                    ></a>
                    <a href="#" title="WhatsApp"
                        ><i class="fab fa-whatsapp"></i
                    ></a>
                    <a href="#" title="LinkedIn"
                        ><i class="fab fa-linkedin-in"></i
                    ></a>
                </div>

                <div class="footer-bottom">
                    <p>
                        &copy; 2025 Óptica Vision. Todos los derechos
                        reservados.
                    </p>
                    <p>
                        Registro Sanitario INVIMA: NSOC-SO123456 | RUT:
                        900.123.456-7
                    </p>
                </div>
            </div>
        </footer>

        <!-- SCRIPT NOTIFICACIONES - SIN MODIFICAR -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const btn = document.getElementById("btnNotifications");
                const box = document.getElementById("notificationsBox");
                const list = document.getElementById("notificationsList");
                const badge = document.getElementById("notificationBadge");

                // === Lógica para el badge de notificaciones ===
                const checkNotificationStatus = async () => {
                    if (!btn) return; // Solo si el botón existe (usuario autenticado)

                    const lastCheck = localStorage.getItem('lastNotificationCheck');
                    let url = '/notifications/status';
                    if (lastCheck) {
                        // Adjuntar como parámetro de consulta
                        url += `?since=${encodeURIComponent(lastCheck)}`;
                    }

                    try {
                        const response = await fetch(url);
                        if (!response.ok) return;

                        const data = await response.json();

                        if (data.count > 0) {
                            badge.textContent = data.count > 9 ? '9+' : data.count;
                            badge.style.display = 'flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    } catch (error) {
                        console.error("Error al verificar estado de notificaciones:", error);
                        badge.style.display = 'none';
                    }
                };

                // Si el usuario está logueado, verificar notificaciones periódicamente
                if (btn) {
                    checkNotificationStatus();
                    setInterval(checkNotificationStatus, 30000); // Cada 30 segundos
                }

                if (btn) { // Asegurarse de que el botón existe antes de añadir el listener
                    btn.addEventListener("click", async () => {
                        const isVisible = box.style.display === "block";
                        box.style.display = isVisible ? "none" : "block";

                        if (!isVisible) { // Si se acaba de abrir
                            // Ocultar el badge y guardar la fecha de revisión
                            badge.style.display = 'none';
                            localStorage.setItem('lastNotificationCheck', new Date().toISOString());

                            list.innerHTML = "<li>Cargando...</li>";

                            try {
                                let response = await fetch("/notifications");
                                let data = await response.json();
                                list.innerHTML = "";

                                if (data.length === 0) {
                                    list.innerHTML = "<li>No hay compras recientes.</li>";
                                } else {
                                    data.forEach((p) => {
                                        const { product_name, status, purchased_at } = p;
                                        const li = document.createElement("li");
                                        li.style.borderBottom = "1px solid #eee";
                                        li.style.padding = "8px 0";

                                        const statusClass = status === 'aceptada' ? 'color: green;' : (status === 'rechazada' ? 'color: red;' : '');

                                        li.innerHTML = `
                                            ${product_name} → <strong style="${statusClass}">${status}</strong>
                                            <br>
                                            <small style="color: #666;">${new Date(purchased_at).toLocaleString()}</small>
                                        `;
                                        list.appendChild(li);
                                    });
                                }
                            } catch (error) {
                                console.error("Error cargando notificaciones:", error);
                                list.innerHTML = "<li>No se pudieron cargar las notificaciones.</li>";
                            }
                        }
                    });
                }

                // FAQ Toggle
                document
                    .querySelectorAll(".faq-question")
                    .forEach((question) => {
                        question.addEventListener("click", () => {
                            const answer = question.nextElementSibling;
                            const icon = question.querySelector("i");
                            const isVisible = answer.style.display === "block";

                            // Cerrar todas las respuestas y resetear iconos
                            document
                                .querySelectorAll(".faq-answer")
                                .forEach((ans) => {
                                    ans.style.display = "none";
                                });
                            document
                                .querySelectorAll(".faq-question")
                                .forEach((q) => {
                                    q.classList.remove("active");
                                });

                            // Mostrar/ocultar la respuesta clickeada
                            if (!isVisible) {
                                answer.style.display = "block";
                                question.classList.add("active");
                            }
                        });
                    });

                // Smooth scrolling para los enlaces del menú
                document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                    anchor.addEventListener("click", function (e) {
                        e.preventDefault();
                        const target = document.querySelector(
                            this.getAttribute("href")
                        );
                        if (target) {
                            target.scrollIntoView({
                                behavior: "smooth",
                                block: "start",
                            });
                        }
                    });
                });

                // Animaciones al hacer scroll
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: "0px 0px -50px 0px",
                };

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("visible");
                        }
                    });
                }, observerOptions);

                document.querySelectorAll(".fade-in").forEach((el) => {
                    observer.observe(el);
                });

                // Contador animado para estadísticas
                function animateCounter(element, target, duration = 2000) {
                    let start = 0;
                    const increment = target / (duration / 16);
                    const timer = setInterval(() => {
                        start += increment;
                        if (target >= 1000) {
                            element.textContent =
                                Math.floor(start).toLocaleString() + "+";
                        } else {
                            element.textContent = Math.floor(start * 10) / 10;
                        }
                        if (start >= target) {
                            if (target >= 1000) {
                                element.textContent =
                                    target.toLocaleString() + "+";
                            } else {
                                element.textContent = target;
                            }
                            clearInterval(timer);
                        }
                    }, 16);
                }

                // Iniciar contadores cuando sean visibles
                const statsObserver = new IntersectionObserver(
                    function (entries) {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                const counters =
                                    entry.target.querySelectorAll(
                                        ".stat-item h3"
                                    );
                                counters.forEach((counter) => {
                                    const text = counter.textContent;
                                    if (text.includes("25,000")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 25000);
                                    } else if (text.includes("20")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 20);
                                    } else if (text.includes("1,200")) {
                                        counter.textContent = "0";
                                        animateCounter(counter, 1200);
                                    } else if (text.includes("4.9")) {
                                        counter.textContent = "0.0";
                                        animateCounter(counter, 4.9);
                                    }
                                });
                                statsObserver.unobserve(entry.target);
                            }
                        });
                    },
                    { threshold: 0.5 }
                );

                const statsSection = document.querySelector("#nosotros");
                if (statsSection) {
                    statsObserver.observe(statsSection);
                }
            });
        </script>
        <script>
    // Inicialización para el carrusel de PRODUCTOS
    const productsSwiper = new Swiper('.products-carousel', {
      // Bucle infinito
      loop: true,
      
      // Espacio entre cada tarjeta
      spaceBetween: 30,

      // Paginación (los puntos inferiores)
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      // Flechas de navegación
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      // Configuración Responsive (número de slides por pantalla)
      breakpoints: {
        // Cuando la ventana es >= 320px
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        // Cuando la ventana es >= 768px
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        // Cuando la ventana es >= 1024px
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        },
        // Cuando la ventana es >= 1200px
        1200: {
            slidesPerView: 4,
            spaceBetween: 30
        }
      }
    });

    // Inicialización para el carrusel de OFERTAS
    // (es el mismo código, solo cambia el selector '.offers-carousel')
    const offersSwiper = new Swiper('.offers-carousel', {
      loop: true,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      }
    });
</script>
<script>
document.getElementById("searchForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    let query = document.getElementById("searchInput").value.toLowerCase().trim();
    if (!query) return;

    // Buscar en productos normales
    let productos = document.querySelectorAll("#productos .card h3");
    for (let p of productos) {
        if (p.textContent.toLowerCase().includes(query)) {
            document.getElementById("productos").scrollIntoView({ behavior: "smooth" });
            p.scrollIntoView({ behavior: "smooth", block: "center" });
            p.style.backgroundColor = "#b2f2bb"; // verde pastel
p.style.borderRadius = "8px";        // esquinas redondeadas
p.style.padding = "4px";             // un poco de espacio interno
// resaltado temporal
            setTimeout(() => p.style.backgroundColor = "transparent", 2000);
            return;
        }
    }

    // Buscar en ofertas
    let ofertas = document.querySelectorAll("#ofertas .card h3");
    for (let o of ofertas) {
        if (o.textContent.toLowerCase().includes(query)) {
            document.getElementById("ofertas").scrollIntoView({ behavior: "smooth" });
            o.scrollIntoView({ behavior: "smooth", block: "center" });
           p.style.backgroundColor = "#b2f2bb"; // verde pastel
           p.style.borderRadius = "8px";        // esquinas redondeadas
           p.style.padding = "4px";             // un poco de espacio interno

            setTimeout(() => o.style.backgroundColor = "transparent", 2000);
            return;
        }
    }

    // Si no encontró nada
    alert("No se encontró ningún producto con ese nombre.");
});
</script>

<script>
    document.getElementById("hamburger").addEventListener("click", function() {
        document.getElementById("menu").classList.toggle("show");
    });
</script>



    </body>
</html>
