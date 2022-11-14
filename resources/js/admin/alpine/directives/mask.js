import Inputmask from 'inputmask'

export default (el, { expression }) => {
    Inputmask(expression).mask(el)
}
