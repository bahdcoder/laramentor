import { mount } from '@vue/test-utils'

import skills from '../__mocks__/skills'
import Request from '../../components/Request.vue'
import RequestButtons from '../../components/RequestButtons.vue'

test('it sets the type to component data when the SET_REQUEST_TYPE event is triggered', () => {
  const requestButtons = mount(RequestButtons)

  const requestForm = mount(Request, {
    propsData: {
      skills
    }
  })
  
  const dropdownbutton = requestButtons.find('.dropdown-item')

  dropdownbutton.trigger('click')

  // TODO: Find a better way to test this. this assertion is assuming that the .dropdown-item clicked is the first one which triggers Mentor.
  expect(requestForm.vm.type).toBe('Mentor')

  // TODO: Find a way of asserting that the modal function was actually called.
  expect($).toHaveBeenCalledWith('#request')
})