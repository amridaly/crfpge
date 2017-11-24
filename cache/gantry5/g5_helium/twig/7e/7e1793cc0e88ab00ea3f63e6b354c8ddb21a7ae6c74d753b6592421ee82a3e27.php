<?php

/* @particles/contenttabs.html.twig */
class __TwigTemplate_13ccb0f974400bc02dbbd9ba85168d5875cd494cb30c5f19d78658b6ba3e0fd8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@nucleus/partials/particle.html.twig", "@particles/contenttabs.html.twig", 1);
        $this->blocks = array(
            'particle' => array($this, 'block_particle'),
            'javascript' => array($this, 'block_javascript'),
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
        <div class=\"g-contenttabs\">
            <div id=\"g-contenttabs-";
        // line 9
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "\" class=\"g-contenttabs-container\">
                <ul class=\"g-contenttabs-tab-wrapper-container\">

                    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "                        <li class=\"g-contenttabs-tab-wrapper\">
                            <span class=\"g-contenttabs-tab-wrapper-head\">
                                <a class=\"g-contenttabs-tab\" href=\"#g-contenttabs-item-";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
                                    <span class=\"g-contenttabs-tab-title\">";
            // line 16
            echo $this->getAttribute($context["item"], "title", array());
            echo "</span>
                                </a>
                            </span>
                        </li>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "
                </ul>

                <div class=\"clearfix\"></div>

                <ul class=\"g-contenttabs-content-wrapper-container\">

                    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["particle"] ?? null), "items", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 29
            echo "                        <li class=\"g-contenttabs-tab-wrapper\">
                            <div class=\"g-contenttabs-tab-wrapper-body\">
                                <div id=\"g-contenttabs-item-";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" class=\"g-contenttabs-content\">
                                    ";
            // line 32
            echo $this->getAttribute($context["item"], "content", array());
            echo "
                                </div>
                            </div>
                        </li>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "
                </ul>
                <div class=\"clearfix\"></div>
            </div>
        </div>
    </div>

";
    }

    // line 46
    public function block_javascript($context, array $blocks = array())
    {
        // line 47
        echo "    ";
        $this->getAttribute(($context["gantry"] ?? null), "load", array(0 => "jquery"), "method");
        // line 48
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->urlFunc("gantry-theme://js/juitabs.js"), "html", null, true);
        echo "\"></script>
";
    }

    // line 51
    public function block_javascript_footer($context, array $blocks = array())
    {
        // line 52
        echo "    <script type=\"text/javascript\">
        jQuery(window).load(function() {
            jQuery('#g-contenttabs-";
        // line 54
        echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
        echo "').tabs({
                show: {
                    ";
        // line 56
        if ((((($this->getAttribute(($context["particle"] ?? null), "animation", array()) == "up") || ($this->getAttribute(($context["particle"] ?? null), "animation", array()) == "down")) || ($this->getAttribute(($context["particle"] ?? null), "animation", array()) == "left")) || ($this->getAttribute(($context["particle"] ?? null), "animation", array()) == "right"))) {
            // line 57
            echo "                    effect: 'slide',
                    direction: '";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute(($context["particle"] ?? null), "animation", array()), "html", null, true);
            echo "',
                    ";
        } else {
            // line 60
            echo "                    effect: '";
            echo twig_escape_filter($this->env, (($this->getAttribute(($context["particle"] ?? null), "animation", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["particle"] ?? null), "animation", array()), "slide")) : ("slide")), "html", null, true);
            echo "',
                    ";
        }
        // line 62
        echo "                    duration: 500
                }
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "@particles/contenttabs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 62,  199 => 60,  194 => 58,  191 => 57,  189 => 56,  184 => 54,  180 => 52,  177 => 51,  170 => 48,  167 => 47,  164 => 46,  153 => 37,  134 => 32,  130 => 31,  126 => 29,  109 => 28,  100 => 21,  81 => 16,  77 => 15,  73 => 13,  56 => 12,  50 => 9,  46 => 7,  40 => 6,  36 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@particles/contenttabs.html.twig", "C:\\wamp64\\www\\CRFPGE\\templates\\g5_helium\\particles\\contenttabs.html.twig");
    }
}
