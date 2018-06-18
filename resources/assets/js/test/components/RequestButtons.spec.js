import { mount } from '@vue/test-utils'

import EventBus from '../../event-bus'
import { SET_REQUEST_TYPE } from '../../events'
import RequestButtons from '../../components/RequestButtons.vue'

test('it emits a request event when request type is clicked', () => {
  const fakeListener = jest.fn()
  EventBus.$on(SET_REQUEST_TYPE, fakeListener)

  const wrapper = mount(RequestButtons)

  wrapper.findAll('.dropdown-item').trigger('click')

  expect(fakeListener).toHaveBeenCalledWith('Mentee')
  expect(fakeListener).toHaveBeenCalledWith('Mentor')
})