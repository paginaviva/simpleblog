<?php
/**
 * Componente: footer.php
 * 
 * Archivo: /includes/footer.php
 * Propósito: Pie de página reutilizable (créditos, redes sociales, scripts)
 * 
 * Proyecto: Meridiano Blog - Sistema Dinámico de Posts
 * Fecha: 2025-11-12
 */

// =====================================================
// INCLUIR CONFIGURACIÓN DE RUTAS
// =====================================================

require_once __DIR__ . '/../config/routes.php';

?>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <!-- Twitter -->
                            <li class="list-inline-item">
                                <a href="#!" title="Síguenos en Twitter">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            
                            <!-- Facebook -->
                            <li class="list-inline-item">
                                <a href="#!" title="Síguenos en Facebook">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            
                            <!-- GitHub -->
                            <li class="list-inline-item">
                                <a href="#!" title="Síguenos en GitHub">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Copyright -->
                        <div class="small text-center text-muted fst-italic">
                            Copyright &copy; Meridiano Blog 2025
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Core theme JS-->
        <script src="<?php echo RUTA_JS; ?>scripts.js"></script>
    </body>
</html>
