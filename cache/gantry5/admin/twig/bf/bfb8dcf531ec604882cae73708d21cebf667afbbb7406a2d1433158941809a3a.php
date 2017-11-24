<?php

/* @gantry-admin/pages/install/install.html.twig */
class __TwigTemplate_20f3ff11b0984dbcd6eb8433c7dd747e12a1f5935e98b5e43ab61d6e577dc674 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'gantry' => array($this, 'block_gantry'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((((($context["ajax"] ?? null) - ($context["suffix"] ?? null))) ? ("@gantry-admin/partials/ajax.html.twig") : ("@gantry-admin/partials/base.html.twig")), "@gantry-admin/pages/install/install.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_gantry($context, array $blocks = array())
    {
        // line 4
        echo "    <div id=\"install\">
        <span class=\"float-right\">
            <button class=\"button button-back-to-conf\" tabindex=\"0\"
                    aria-label=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_BACK_SETUP"), "html", null, true);
        echo "\"><i class=\"fa fa-fw fa-fw fa-arrow-left\" aria-hidden=\"true\"></i>
                <span>";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_BACK_SETUP"), "html", null, true);
        echo "</span></button>
        </span>
        <h2 class=\"page-title\">
            ";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_SAMPLE_DATA_INSTALLED"), "html", null, true);
        echo "
        </h2>
    </div>

    <div>
        <p>";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_INSTALLER_ACTIONS"), "html", null, true);
        echo "</p>
        <ul>
            ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 19
            echo "                <li>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "text", array()), "html", null, true);
            echo "</li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "        </ul>
    </div>
";
    }

    public function getTemplateName()
    {
        return "@gantry-admin/pages/install/install.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 21,  62 => 19,  58 => 18,  53 => 16,  45 => 11,  39 => 8,  35 => 7,  30 => 4,  27 => 3,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/pages/install/install.html.twig", "C:\\wamp64\\www\\CRFPGE\\administrator\\components\\com_gantry5\\templates\\pages\\install\\install.html.twig");
    }
}
