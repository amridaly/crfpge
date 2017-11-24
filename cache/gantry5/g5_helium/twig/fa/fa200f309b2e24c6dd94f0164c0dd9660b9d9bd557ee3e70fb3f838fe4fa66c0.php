<?php

/* @particles/owlcarousel.html.twig */
class __TwigTemplate_570baa65d842dcbccc38ea2aa4e7184c9a119f57921c0fd1a43b129d92011cbc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/owlcarousel.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@nucleus/partials/particle.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_particle($context, array $blocks = array())
    {
        // line 4
        echo "
    <div class=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "class", array()));
        echo "\">
        ";
        // line 6
        if ($this->getAttribute(($context["particle"] ?? null), "title", array())) {
            echo "<h2 class=\"g-title\">";
            echo $this->getAttribute(($context["particle"] ?? null), "title", array());
            echo "</h2>";
        }
        // line 7
        echo "
        <div id=\"g-owlcarousel-";
        // line 8
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" class=\"g-owlcarousel owl-carousel ";
        if (($this->getAttribute(($context["particle"] ?? null), "imageOverlay", array()) == "enable")) {
            echo "has-color-overlay";
        }
        echo "\">

            ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 11
            echo "                <div class=\"g-owlcarousel-item owl-item\">
                    <div class=\"g-owlcarousel-item-wrapper\">
                        <div class=\"g-owlcarousel-item-img\">
                            <img src=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "image", array())));
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
            echo "\" />
                        </div>
                        <div class=\"g-owlcarousel-item-content-container\">
                            <div class=\"g-owlcarousel-item-content-wrapper\">
                                <div class=\"g-owlcarousel-item-content\">
                                    ";
            // line 19
            if ($this->getAttribute($context["item"], "title", array())) {
                // line 20
                echo "                                        <h1 class=\"g-owlcarousel-item-title\">";
                echo $this->getAttribute($context["item"], "title", array());
                echo "</h1>";
            }
            // line 21
            echo "                                    ";
            if ($this->getAttribute($context["item"], "desc", array())) {
                // line 22
                echo "                                        <h2 class=\"g-owlcarousel-item-desc\">";
                echo $this->getAttribute($context["item"], "desc", array());
                echo "</h2>";
            }
            // line 23
            echo "                                    ";
            if ($this->getAttribute($context["item"], "link", array())) {
                // line 24
                echo "                                        <div class=\"g-owlcarousel-item-link\">
                                            <a target=\"_self\" class=\"g-owlcarousel-item-button button ";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonclass", array()));
                echo "\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                echo "\">
                                                ";
                // line 26
                echo $this->getAttribute($context["item"], "linktext", array());
                echo "
                                            </a>
                                        </div>
                                    ";
            }
            // line 30
            echo "                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "
        </div>
    </div>

";
    }

    // line 42
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 43
        echo "    ";
        $this->getAttribute(($context["gantry"] ?? null), "load", array(0 => "jquery"), "method");
        // line 44
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/owlcarousel.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\">
        jQuery(window).load(function() {
            jQuery('#g-owlcarousel-";
        // line 47
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "').owlCarousel({
                items: 1,
                rtl: ";
        // line 49
        if (($this->getAttribute($this->getAttribute(($context["gantry"] ?? null), "page", array()), "direction", array()) == "rtl")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ",
                loop: true,
                ";
        // line 51
        if (($this->getAttribute(($context["particle"] ?? null), "nav", array()) == "enable")) {
            // line 52
            echo "                nav: true,
                navText: ['";
            // line 53
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "prevText", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "prevText", array()), "<i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i>")) : ("<i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i>")), "js"), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "nextText", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "nextText", array()), "<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>")) : ("<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>")), "js"), "html", null, true);
            echo "'],
                ";
        } else {
            // line 55
            echo "                nav: false,
                ";
        }
        // line 57
        echo "                ";
        if (($this->getAttribute(($context["particle"] ?? null), "dots", array()) == "enable")) {
            // line 58
            echo "                dots: true,
                ";
        } else {
            // line 60
            echo "                dots: false,
                ";
        }
        // line 62
        echo "                ";
        if (($this->getAttribute(($context["particle"] ?? null), "autoplay", array()) == "enable")) {
            // line 63
            echo "                autoplay: true,
                autoplayTimeout: ";
            // line 64
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "autoplaySpeed", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "autoplaySpeed", array()), "5000")) : ("5000")), "html", null, true);
            echo ",
                ";
        } else {
            // line 66
            echo "                autoplay: false,
                ";
        }
        // line 68
        echo "            })
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "@particles/owlcarousel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 68,  194 => 66,  189 => 64,  186 => 63,  183 => 62,  179 => 60,  175 => 58,  172 => 57,  168 => 55,  161 => 53,  158 => 52,  156 => 51,  147 => 49,  142 => 47,  135 => 44,  132 => 43,  129 => 42,  121 => 36,  110 => 30,  103 => 26,  97 => 25,  94 => 24,  91 => 23,  86 => 22,  83 => 21,  78 => 20,  76 => 19,  66 => 14,  61 => 11,  57 => 10,  48 => 8,  45 => 7,  39 => 6,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/owlcarousel.html.twig", "C:\\wamp64\\www\\CRFPGE\\templates\\g5_helium\\particles\\owlcarousel.html.twig");
    }
}
