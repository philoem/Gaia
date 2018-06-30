/**
 * Classe pour afficher, de façon dynamique et ludique, toutes les annonces avec leurs photos et descriptifs 
 * Accessible aux personnes non-membres également
 */
class Portfolio {

    /**
     * 
     * @param {string} selector
     */
    constructor (selector) {

        this.active = null
        this.activeProject = null
        this.container = document.querySelector(selector)
        if (this.container === null) {
            throw new Error (`L'élément ${selector} n'existe pas`)
        }

        this.children = Array.prototype.slice.call(this.container.querySelectorAll('.project'))
        this.children.forEach((child) => {
            child.addEventListener('click', (e) => {
                e.preventDefault()
                this.show(child)
            })
            child.addEventListener('keypress', (e) => {
                if (e.keyCode === 13) {
                    this.show(child)
                }

            })
        });

    }

    /**
     * Fait apparaître le texte entier de l'annonce
     * @param {HTMLElement} content
     * 
     */
    show (child) {

        let content = child.querySelector('.project_body').cloneNode(true)
        let offset = 0
        if (this.active !== null) {
            this.slideUp(this.active)
            if (this.active.offsetTop < child.offsetTop) {
                offset = this.active.offsetHeight
            }
        }
        if (this.activeProject === child) {
            this.active = null
            this.activeProject = null
        } else {

            child.after(content)
            this.slideDown(content)
            this.scrollTo(child, offset)
            this.active = content
            this.activeProject = child

        }

    }

    /**
     * Permet de faire un effet d'animation descendant 
     *  @param {HTMLElement} element
     */
    slideDown (element) {

        let height = element.offsetHeight
        element.style.height = '0px'
        element.style.transitionDuration = '0.7s'
        element.offsetHeight
        element.style.height = height + 'px'
        window.setTimeout(function() {
            element.style.height = null
        }, 500)

    }

    /**
     * Permet de faire un effet d'animation ascendant 
     *  @param {HTMLElement} element
     */
    slideUp (element) {

        let height = element.offsetHeight
        element.style.height = height + 'px'
        element.offsetHeight
        element.style.height = '0px'
        window.setTimeout(function () {
            element.parentNode.removeChild(element)
        }, 500)

    }

    /**
     * Effet animation sur l'apparition du texte de l'annonce
     * @param {HTMLElement} element 
     * @param {int} offset
     */
    scrollTo (element, offset = 0) {

        window.scrollTo({
            behavior: 'smooth',
            left: 0,
            top: element.offsetTop - offset
        })
    }
}

new Portfolio('.portfolio')
