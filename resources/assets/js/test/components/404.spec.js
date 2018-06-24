import { mount } from '@vue/test-utils'
import NotFound from '../../components/404.vue'

test('displays a not found message when mounted', () => {
  const wrapper = mount(NotFound)

  expect(wrapper.text()).toMatch('ROUTE WAS NOT FOUND.')
});
