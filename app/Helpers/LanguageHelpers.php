<?php

// if (!function_exists('getLocalizedField')) {
//     function getLocalizedField($field, $locale)
//     {
//         $decodedField = json_decode($field, true);
//         if (is_array($decodedField) && isset($decodedField[$locale])) {
//             return $decodedField[$locale];
//         }
//         return $field; // Return original value if not localized
//     }
// }

if (!function_exists('getLocalizedField')) {
    function getLocalizedField($field, $locale)
    {
        // If already an array, use it directly
        if (is_array($field)) {
            return $field[$locale] ?? $field['en'] ?? '';
        }
        // Decode if it's a string
        $decodedField = json_decode($field, true);
        if (is_array($decodedField) && isset($decodedField[$locale])) {
            return $decodedField[$locale];
        }
        return $field; // Return original if not a localized array
    }
}


if (!function_exists('localizeHeroSection')) {
    function localizeHeroSection($model, $locale)
    {
        if (!$model) return null;

        $model->title = getLocalizedField($model->title, $locale);
        $model->subtitle = getLocalizedField($model->subtitle, $locale);
        $model->description = getLocalizedField($model->description, $locale);

        return $model;
    }
}

if (!function_exists('localizeIntroductionSection')) {
    function localizeIntroductionSection($introductionSection, $locale)
    {
        if (!$introductionSection) {
            return null;
        }
        // Localize textual fields
        $introductionSection->title = getLocalizedField($introductionSection->title, $locale);
        $introductionSection->subtitle = getLocalizedField($introductionSection->subtitle, $locale);
        $introductionSection->description = getLocalizedField($introductionSection->description, $locale);
        $introductionSection->images = json_decode($introductionSection->images, true);;
        return $introductionSection;
    }
}

if (!function_exists('localizeFeatureImage')) {
    function localizeFeatureImage($featureImage, $locale)
    {
        if (!$featureImage) {
            return null;
        }

        // Localize textual fields
        $featureImage->title = getLocalizedField($featureImage->title, $locale);
        $featureImage->subtitle = getLocalizedField($featureImage->subtitle, $locale);
        $featureImage->description = getLocalizedField($featureImage->description, $locale);

        return $featureImage;
    }
}


if (!function_exists('localizeProcedure')) {
    function localizeProcedure($procedure, $locale)
    {
        if (!$procedure) {
            return null;
        }

        // Localize textual fields
        $procedure->icon = getLocalizedField($procedure->icon, $locale);
        $procedure->title = getLocalizedField($procedure->title, $locale);
        $procedure->subtitle = getLocalizedField($procedure->subtitle, $locale);
        $procedure->description = getLocalizedField($procedure->description, $locale);

        return $procedure;
    }
}


if (!function_exists('localizeFeature')) {
    function localizeFeature($feature, $locale)
    {
        if (!$feature) {
            return null;
        }

        $feature->icon = getLocalizedField($feature->icon, $locale);
        $feature->title = getLocalizedField($feature->title, $locale);
        $feature->subtitle = getLocalizedField($feature->subtitle, $locale);
        $feature->description = getLocalizedField($feature->description, $locale);

        return $feature;
    }
}

if (!function_exists('localizeWhyChooseUs')) {
    function localizeWhyChooseUs($whyChooseUs, $locale)
    {
        if (!$whyChooseUs) {
            return null;
        }

        $whyChooseUs->icon = getLocalizedField($whyChooseUs->icon, $locale);
        $whyChooseUs->title = getLocalizedField($whyChooseUs->title, $locale);
        $whyChooseUs->subtitle = getLocalizedField($whyChooseUs->subtitle, $locale);
        $whyChooseUs->description = getLocalizedField($whyChooseUs->description, $locale);

        return $whyChooseUs;
    }
}

if (!function_exists('localizeWhyUsImage')) {
    function localizeWhyUsImage($whyUsImage, $locale)
    {
        if (!$whyUsImage) {
            return null;
        }

        $whyUsImage->title = getLocalizedField($whyUsImage->title, $locale);
        $whyUsImage->subtitle = getLocalizedField($whyUsImage->subtitle, $locale);
        $whyUsImage->description = getLocalizedField($whyUsImage->description, $locale);

        return $whyUsImage;
    }
}




if (!function_exists('localizeCTA')) {
    function localizeCTA($cta, $locale)
    {
        if (!$cta) {
            return null;
        }

        // Localize textual fields
        $cta->title = getLocalizedField($cta->title, $locale);
        $cta->subtitle = getLocalizedField($cta->subtitle, $locale);
        $cta->button_text = getLocalizedField($cta->button_text, $locale);

        return $cta;
    }
}

if (!function_exists('localizeTestimonial')) {
    function localizeTestimonial($testimonial, $locale)
    {
        if (!$testimonial) {
            return null;
        }
        // Localize textual fields
        $testimonial->name = getLocalizedField($testimonial->name, $locale);
        $testimonial->feedback = getLocalizedField($testimonial->feedback, $locale);
        $testimonial->designation = getLocalizedField($testimonial->designation, $locale);
        return $testimonial;
    }
}


if (!function_exists('localizeSectionTitle')) {
    function localizeSectionTitle($sectionTitle, $locale)
    {
        if (!$sectionTitle) {
            return null;
        }
        // Localize textual fields
        $sectionTitle->title = getLocalizedField($sectionTitle->title, $locale);
        $sectionTitle->subtitle = getLocalizedField($sectionTitle->subtitle, $locale);
        return $sectionTitle;
    }
}

if (!function_exists('localize_blog')) {
    function localize_blog($blog, $locale)
    {
        if (!$blog) {
            return null;
        }
        $blog->title = getLocalizedField($blog->title, $locale);
        $blog->content = getLocalizedField($blog->content, $locale);
        return $blog;
    }
}

if (!function_exists('localize_blog_category')) {
    function localize_blog_category($blogCategory, $locale)
    {
        if (!$blogCategory) {
            return null;
        }
        $blogCategory->name = getLocalizedField($blogCategory->name, $locale);
        return $blogCategory;
    }
}

if (!function_exists('localizeDocumentRequired')) {
    function localizeDocumentRequired($documentRequired, $locale)
    {
        if (!$documentRequired) {
            return null;
        }

        // Localize textual fields
        $documentRequired->title = getLocalizedField($documentRequired->title, $locale);
        $documentRequired->description = getLocalizedField($documentRequired->description, $locale);

        return $documentRequired;
    }
}

if (!function_exists('localizeFaq')) {
    function localizeFaq($faq, $locale)
    {
        if (!$faq) {
            return null;
        }

        // Localize textual fields
        $faq->question = getLocalizedField($faq->question, $locale);
        $faq->answer = getLocalizedField($faq->answer, $locale);

        return $faq;
    }
}





if (!function_exists('getImagePath')) {
    function getImagePath($image)
    {
        if ($image) {
            $imagePath = trim($image, '"'); // Remove extra quotes if they exist
            return $imagePath;
        }
        return null;
    }
}
