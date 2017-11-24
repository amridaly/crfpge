<?php

/* @particles/contentcubes.html.twig */
class __TwigTemplate_679349df8d32f05c4cd09a55d2895a2ab500d24403b872ccdebf7db1578a1aed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/contentcubes.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
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
<div class=\"g-contentcubes ";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["particle"] ?? null), "css", array()), "class", array()), "html", null, true);
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
    ";
        // line 8
        if ($this->getAttribute(($context["particle"] ?? null), "items", array())) {
            // line 9
            echo "        <div class=\"cube-items-wrapper\">

            ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 12
                echo "                <div class=\"item image-position-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "imageposition", array()), "html", null, true);
                echo " cube-row g-grid\">
                    <div class=\"g-block size-50\">
                        ";
                // line 14
                if ($this->getAttribute($context["item"], "image", array())) {
                    // line 15
                    echo "                            <div class=\"cube-image-wrapper\">
                                <img src=\"";
                    // line 16
                    echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc($this->getAttribute($context["item"], "image", array())));
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                    echo "\" class=\"cube-image\" />
                            </div>
                        ";
                }
                // line 19
                echo "                    </div>

                    <div class=\"g-block size-50\">
                        <div class=\"cube-content-wrapper\">
                            ";
                // line 23
                if ($this->getAttribute($context["item"], "label", array())) {
                    // line 24
                    echo "                                <div class=\"item-label\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "label", array()));
                    echo "</div>
                            ";
                }
                // line 26
                echo "
                            <div class=\"item-title\">
                                ";
                // line 28
                if ($this->getAttribute($context["item"], "link", array())) {
                    // line 29
                    echo "                                <a target=\"";
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["item"], "buttontarget", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["item"], "buttontarget", array()), "_self")) : ("_self")));
                    echo "\" class=\"item-link ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "buttonclass", array()));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "link", array()));
                    echo "\">
                                    ";
                }
                // line 31
                echo "
                                    ";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", array()));
                echo "

                                    ";
                // line 34
                if ($this->getAttribute($context["item"], "link", array())) {
                    // line 35
                    echo "                                    <span class=\"item-link-text\">";
                    echo $this->getAttribute($context["item"], "linktext", array());
                    echo "</span>
                                </a>
                                ";
                }
                // line 38
                echo "                            </div>

                            ";
                // line 40
                if ($this->getAttribute($context["item"], "tags", array())) {
                    // line 41
                    echo "                                <div class=\"item-tags\">

                                    ";
                    // line 43
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "tags", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 44
                        echo "                                        <span class=\"tag\">
                                            <a target=\"";
                        // line 45
                        echo twig_escape_filter($this->env, (($this->getAttribute($context["tag"], "target", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["tag"], "target", array()), "_self")) : ("_self")));
                        echo "\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "link", array()));
                        echo "\">
                                                ";
                        // line 46
                        if ($this->getAttribute($context["tag"], "icon", array())) {
                            echo "<i class=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "icon", array()), "html", null, true);
                            echo "\"></i> ";
                        }
                        // line 47
                        echo "                                                ";
                        echo $this->getAttribute($context["tag"], "text", array());
                        echo "
                                            </a>
                                        </span>
                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 51
                    echo "
                                </div>
                            ";
                }
                // line 54
                echo "                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "
        </div>
    ";
        }
        // line 61
        echo "</div>

";
    }

    public function getTemplateName()
    {
        return "@particles/contentcubes.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 61,  177 => 58,  168 => 54,  163 => 51,  152 => 47,  146 => 46,  140 => 45,  137 => 44,  133 => 43,  129 => 41,  127 => 40,  123 => 38,  116 => 35,  114 => 34,  109 => 32,  106 => 31,  96 => 29,  94 => 28,  90 => 26,  84 => 24,  82 => 23,  76 => 19,  68 => 16,  65 => 15,  63 => 14,  57 => 12,  53 => 11,  49 => 9,  47 => 8,  44 => 7,  38 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/contentcubes.html.twig", "C:\\wamp64\\www\\CRFPGE\\templates\\g5_helium\\particles\\contentcubes.html.twig");
    }
}
