<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_a4a4ad70e68464b3d61be601cf0a15e6d298f5e358cc8c5dea7ae3c4159c7c4b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7e488bbab37ccb0e65edda5f84b22b2c74d78d92cee6816c0d3b990ff3d81d78 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_7e488bbab37ccb0e65edda5f84b22b2c74d78d92cee6816c0d3b990ff3d81d78->enter($__internal_7e488bbab37ccb0e65edda5f84b22b2c74d78d92cee6816c0d3b990ff3d81d78_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7e488bbab37ccb0e65edda5f84b22b2c74d78d92cee6816c0d3b990ff3d81d78->leave($__internal_7e488bbab37ccb0e65edda5f84b22b2c74d78d92cee6816c0d3b990ff3d81d78_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_75fe77d86d3e9522617b02d05bea9a679a618dc80413e49aeb68e7df76ac3354 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_75fe77d86d3e9522617b02d05bea9a679a618dc80413e49aeb68e7df76ac3354->enter($__internal_75fe77d86d3e9522617b02d05bea9a679a618dc80413e49aeb68e7df76ac3354_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_75fe77d86d3e9522617b02d05bea9a679a618dc80413e49aeb68e7df76ac3354->leave($__internal_75fe77d86d3e9522617b02d05bea9a679a618dc80413e49aeb68e7df76ac3354_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_166a6939212ebdc371b1df1b053a407c7c300c3916246d2df1b96790976ba62c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_166a6939212ebdc371b1df1b053a407c7c300c3916246d2df1b96790976ba62c->enter($__internal_166a6939212ebdc371b1df1b053a407c7c300c3916246d2df1b96790976ba62c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_166a6939212ebdc371b1df1b053a407c7c300c3916246d2df1b96790976ba62c->leave($__internal_166a6939212ebdc371b1df1b053a407c7c300c3916246d2df1b96790976ba62c_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_6960b5cbb526160d58101ce268d0874ef816d892964d3a1bfa29b2812ec91056 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6960b5cbb526160d58101ce268d0874ef816d892964d3a1bfa29b2812ec91056->enter($__internal_6960b5cbb526160d58101ce268d0874ef816d892964d3a1bfa29b2812ec91056_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_6960b5cbb526160d58101ce268d0874ef816d892964d3a1bfa29b2812ec91056->leave($__internal_6960b5cbb526160d58101ce268d0874ef816d892964d3a1bfa29b2812ec91056_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "/home/abdelmoughite/MoodMap/moodMap/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/router.html.twig");
    }
}
