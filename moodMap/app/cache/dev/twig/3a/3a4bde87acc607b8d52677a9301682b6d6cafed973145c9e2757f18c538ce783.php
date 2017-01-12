<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_eac7ca5eef45686b65ab0067b95f0a1bd16cf6c9c938498509b64c342c443402 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_6df91aae9572055561f83e1f223852dc2b14589518186ea9d15c8f662091e182 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6df91aae9572055561f83e1f223852dc2b14589518186ea9d15c8f662091e182->enter($__internal_6df91aae9572055561f83e1f223852dc2b14589518186ea9d15c8f662091e182_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6df91aae9572055561f83e1f223852dc2b14589518186ea9d15c8f662091e182->leave($__internal_6df91aae9572055561f83e1f223852dc2b14589518186ea9d15c8f662091e182_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_15dec8c916e9ad83c0a3d03365e34481965a42c0089f4cbb8689cedf8dcc988e = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_15dec8c916e9ad83c0a3d03365e34481965a42c0089f4cbb8689cedf8dcc988e->enter($__internal_15dec8c916e9ad83c0a3d03365e34481965a42c0089f4cbb8689cedf8dcc988e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpFoundationExtension')->generateAbsoluteUrl($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_15dec8c916e9ad83c0a3d03365e34481965a42c0089f4cbb8689cedf8dcc988e->leave($__internal_15dec8c916e9ad83c0a3d03365e34481965a42c0089f4cbb8689cedf8dcc988e_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_3e5b403fc835f31bd4e002c58d03957b476344175d296b29169717357764e45c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3e5b403fc835f31bd4e002c58d03957b476344175d296b29169717357764e45c->enter($__internal_3e5b403fc835f31bd4e002c58d03957b476344175d296b29169717357764e45c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_3e5b403fc835f31bd4e002c58d03957b476344175d296b29169717357764e45c->leave($__internal_3e5b403fc835f31bd4e002c58d03957b476344175d296b29169717357764e45c_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_ef022507ba536decdeaa83447938d30c278a20a671d689d71b3a0e0ab8cca965 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_ef022507ba536decdeaa83447938d30c278a20a671d689d71b3a0e0ab8cca965->enter($__internal_ef022507ba536decdeaa83447938d30c278a20a671d689d71b3a0e0ab8cca965_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_ef022507ba536decdeaa83447938d30c278a20a671d689d71b3a0e0ab8cca965->leave($__internal_ef022507ba536decdeaa83447938d30c278a20a671d689d71b3a0e0ab8cca965_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <link href=\"{{ absolute_url(asset('bundles/framework/css/exception.css')) }}\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
", "@Twig/Exception/exception_full.html.twig", "/home/abdelmoughite/MoodMap/moodMap/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views/Exception/exception_full.html.twig");
    }
}
