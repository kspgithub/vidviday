;(function (window, document) {
    var config = {
        textMore: '...Show more',
        textLess: '...Show less',
    }

    var setHeight = function (element, height) {
        if (!element) {;
            return false;
        }
        else {
            var elementHeight = parseInt(window.getComputedStyle(element, null).height, 10),
                toggleButton = document.createElement('a'),
                text = document.createTextNode(config.textMore),
                parent = element.parentNode;

            toggleButton.src = '#';
            toggleButton.className = 'show-more';
            toggleButton.style.float = 'right';
            toggleButton.style.paddingRight = '15px';
            toggleButton.style.marginTop = '15px';
            toggleButton.appendChild(text);

            parent.insertBefore(toggleButton, element.nextSibling);

            element.setAttribute('data-fullheight', elementHeight);
            element.style.height = height;
            element.style.overflow = 'hidden';
            return toggleButton;
        }
    }

    var toggleHeight = function (element, height) {
        if (!element) {
            return false;
        }
        else {
            var full = element.getAttribute('data-fullheight'),
                currentElementHeight = parseInt(element.style.height, 10);

            element.style.height = full == currentElementHeight ? height : full + 'px';
        }
    }

    var toggleText = function (element) {
        if (!element) {
            return false;
        }
        else {
            var text = element.firstChild.nodeValue;
            element.firstChild.nodeValue = text == config.textMore ? config.textLess : config.textMore;
        }
    }


    var applyToggle = function(elementHeight){
        'use strict';
        return function(){
            toggleHeight(this.previousElementSibling, elementHeight);
            toggleText(this);
        }
    }


    var modifyDomElements = function(className, elementHeight, options = {}){

        config.textMore = options.textMore || config.textMore
        config.textLess = options.textLess || config.textLess

        var elements = document.getElementsByClassName(className);
        var toggleButtonsArray = [];



        for (var index = 0, arrayLength = elements.length; index < arrayLength; index++) {
            var currentElement = elements[index];
            var toggleButton = setHeight(currentElement, elementHeight);
            toggleButtonsArray.push(toggleButton);
        }

        for (var index=0, arrayLength=toggleButtonsArray.length; index<arrayLength; index++){
            toggleButtonsArray[index].onclick = applyToggle(elementHeight);
        }
    }


    window.moreLess = modifyDomElements
})(window, document)

