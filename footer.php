<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package vivaconforto
 */

?>

<footer class="container-fluid color-blue">
    <!-- Menus Footer -->
    <div class="container lists-footer">
        <div class="row">
            <!-- Menu Institucionais -->
            <div class="col-2">
                <section>Institucionais</section>
                <?php 
                    wp_nav_menu( array(
                        'theme_location'  => 'help',
                        'sort_column'     => 'menu_order',
                        'container'       => 'nav',
                        'container_class' => 'menu-vertical menu-container',
                        'menu_class' 	  => 'menu-flex'
                    ) );
                ?>
            </div>
            <!-- Menu Ajuda -->
            <div class="col-2">
                <section>Ajuda</section>
                <?php 
                    wp_nav_menu( array(
                        'theme_location'  => 'inst',
                        'sort_column'     => 'menu_order',
                        'container'       => 'nav',
                        'container_class' => 'menu-vertical menu-container',
                        'menu_class' 	  => 'menu-flex'
                    ) );
                ?>
            </div>
            <!-- Atendimento -->
            <div class="col-3">
                <section>Atendimento</section>
                <ul class="atendimento">
                    <li class="phone-list">
                        Telefone
                        <h1>11 4193-3659</h1>
                    </li>

                    <li class="whats-list">
                        Whatsapp
                        <h1>11 4193-3659</h1>
                    </li>

                    <li class="mail-list">
                        E-mail
                        <small>faleconosco@vivaconforto.com.br</small>
                        <small>sac@vivaconforto.com.br</small>
                    </li>

                    <li>Segunda á Sexta das 9 ás 17h</li>
                </ul>
            </div>
            <!-- Pagamento -->
            <div class="pay">
                <div class="row">
                    <div class="col-12">
                        <section>Pagamento</section>
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/images/mult-cards.png" alt="pagamentos vivaconforto">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 selos"><section>Segurança</section>
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/images/lj-protegida.png" width="130" height="38" alt="loja protegida">
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/images/ebit.png" alt="loja protegida">
                        <img src="<?php echo bloginfo('template_url'); ?>/assets/images/selo.png" alt="loja protegida">
                    </div>
                </div>
                
            </div>
        </div>
    </div>   
</footer>

<footer class="copyright">
    <p>Copyright © 2017-nomedaempresa.com.br. Todos os direitos reservados.</p> 
    <p>Os preços, promoções, condições de pagamento, frete e produtos são válidos exclusivamente para compras realizadas via internet. Fotos meramente ilustrativas.<br>  
    Nome da Empresa Ltda. Me CNPJ: 11.111.111/0001-11 - Endereço: Rua da Rua, 00 - São Paulo - SP</p>
    <p><img src="<?php echo bloginfo('template_url'); ?>/assets/images/auaha.png" alt="design by auaha" width="184" height="71">
</footer>


<?php wp_footer(); ?>
</body>
</html>
