<?php

/* @gantry-admin/partials/php_unsupported.html.twig */
class __TwigTemplate_6131a44d699f6ce3985aee98e430423d17eb47393770c7f7d570c63edf242b27 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["php_version"] = twig_constant("PHP_VERSION");
        // line 2
        echo "
";
        // line 3
        if ((is_string($__internal_bda61e7f49919b82ca6436bab23f379a775de0a343dc79884db70a244cfceba6 = ($context["php_version"] ?? null)) && is_string($__internal_e8070a07d2fcc1455183b7e9e378a4ed1e4ac6438ee5c100e85a23c008027a8f = "5.4") && ('' === $__internal_e8070a07d2fcc1455183b7e9e378a4ed1e4ac6438ee5c100e85a23c008027a8f || 0 === strpos($__internal_bda61e7f49919b82ca6436bab23f379a775de0a343dc79884db70a244cfceba6, $__internal_e8070a07d2fcc1455183b7e9e378a4ed1e4ac6438ee5c100e85a23c008027a8f)))) {
            // line 4
            echo "<div class=\"g-grid\">
    <div class=\"g-block alert alert-warning g-php-outdated\">
        ";
            // line 6
            echo $this->env->getExtension('Gantry\Component\Twig\TwigExtension')->transFilter("GANTRY5_PLATFORM_PHP54_WARNING", ($context["php_version"] ?? null));
            echo "
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@gantry-admin/partials/php_unsupported.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 6,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@gantry-admin/partials/php_unsupported.html.twig", "C:\\wamp64\\www\\CRFPGE\\administrator\\components\\com_gantry5\\templates\\partials\\php_unsupported.html.twig");
    }
}
