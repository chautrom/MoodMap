<?php

/* base.html.twig */
class __TwigTemplate_2d56dae635c5bb7d0d2a548a6684f636d8db12eab8ab6bb636d7eb7e844d228d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_069a3bcc4b44d4a729f5e6586807d46544b1361c3467f4202ebc79d9e7818037 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_069a3bcc4b44d4a729f5e6586807d46544b1361c3467f4202ebc79d9e7818037->enter($__internal_069a3bcc4b44d4a729f5e6586807d46544b1361c3467f4202ebc79d9e7818037_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_069a3bcc4b44d4a729f5e6586807d46544b1361c3467f4202ebc79d9e7818037->leave($__internal_069a3bcc4b44d4a729f5e6586807d46544b1361c3467f4202ebc79d9e7818037_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_f25470aa1c7829b4b4ddf56cae0d9bddc758b690a54309b922a3a2ab2423e389 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_f25470aa1c7829b4b4ddf56cae0d9bddc758b690a54309b922a3a2ab2423e389->enter($__internal_f25470aa1c7829b4b4ddf56cae0d9bddc758b690a54309b922a3a2ab2423e389_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_f25470aa1c7829b4b4ddf56cae0d9bddc758b690a54309b922a3a2ab2423e389->leave($__internal_f25470aa1c7829b4b4ddf56cae0d9bddc758b690a54309b922a3a2ab2423e389_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_5f14dd269d241b6f43628d0b98cfc6b0a0f423a450837eec2bab9f02ae1b4323 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_5f14dd269d241b6f43628d0b98cfc6b0a0f423a450837eec2bab9f02ae1b4323->enter($__internal_5f14dd269d241b6f43628d0b98cfc6b0a0f423a450837eec2bab9f02ae1b4323_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_5f14dd269d241b6f43628d0b98cfc6b0a0f423a450837eec2bab9f02ae1b4323->leave($__internal_5f14dd269d241b6f43628d0b98cfc6b0a0f423a450837eec2bab9f02ae1b4323_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_03da5571fdfadb643d3bb74ca1e255e6236b769b8d7148628ee34b8e5d933ff2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_03da5571fdfadb643d3bb74ca1e255e6236b769b8d7148628ee34b8e5d933ff2->enter($__internal_03da5571fdfadb643d3bb74ca1e255e6236b769b8d7148628ee34b8e5d933ff2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_03da5571fdfadb643d3bb74ca1e255e6236b769b8d7148628ee34b8e5d933ff2->leave($__internal_03da5571fdfadb643d3bb74ca1e255e6236b769b8d7148628ee34b8e5d933ff2_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_eb3e72d5449fc642b6bbbf0b015c8009e0187cf38a2d00948fe545b86bd7fad4 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_eb3e72d5449fc642b6bbbf0b015c8009e0187cf38a2d00948fe545b86bd7fad4->enter($__internal_eb3e72d5449fc642b6bbbf0b015c8009e0187cf38a2d00948fe545b86bd7fad4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_eb3e72d5449fc642b6bbbf0b015c8009e0187cf38a2d00948fe545b86bd7fad4->leave($__internal_eb3e72d5449fc642b6bbbf0b015c8009e0187cf38a2d00948fe545b86bd7fad4_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
", "base.html.twig", "/home/abdelmoughite/MoodMap/moodMap/app/Resources/views/base.html.twig");
    }
}
